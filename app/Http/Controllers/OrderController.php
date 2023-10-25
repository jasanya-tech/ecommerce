<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Models\Cart;
use App\Models\ListOrder;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Uid\Ulid;
use App\Exceptions\CustomException;

class OrderController extends Controller
{
    public function index()
    {
        return view('customer.order.index', [
            'title' => 'cart',
            'orders' => Order::filter(request(['search', 'status_filter', 'sort_option']))->get(),
        ]);
    }

    public function show(Order $order)
    {
        return view('customer.order.show', [
            'title' => 'cart',
            'order' => $order
        ]);
    }

    public function create(Product $product)
    {
        return view('customer.order', [
            'title' => 'order',
            'product' => $product,
            'payments' => Payment::all(),
        ]);
    }

    public function store(Request $request)
    {
        $product = Product::where('id', $request->product_id)->first();
        if ($product == null) {
            return back()->with(
                'error',
                'terjadi kesalahan sistem silangkan order ulang product nil'
            );
        }

        $data = $request->validate([
            'payment_proof' => 'mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'payment' => 'required',
            'address' => 'required',
            'additional_note' => 'nullable',
            'quantity' => 'required|numeric|min:1',
        ], [
            'payment_proof.max' => 'maximal 2mb',
            'payment_proof.mimes' => 'invalid bukti pembayaran, bukti pembayaran harus jpeg,png,jpg,gif,svg,webp',
            'payment.required' => 'tidak boleh dikosongkan',
            'address.required' => 'tidak boleh dikosongkan',
            'quantity.required' => 'tidak boleh dikosongkan',
            'quantity.numeric' => 'harus berupa angka',
            'quantity.min' => 'minimal harus 1',
        ]);
        $data['invoice'] = Ulid::generate();
        $data['user_id'] = Auth::id();
        $data['product_id'] = $request->product_id;
        $data['sub_total'] = $request->sub_total;

        $decreStock = $product->stock - $data['quantity'];
        if ($decreStock < 1) {
            return back()->with(
                'warning',
                'stock telah habis, mohon maaf'
            );
        }

        $paymentProof = FileHelper::optimizeAndUploadPicture($data['payment_proof'], 'orders');

        try {
            DB::beginTransaction();
            $product->update([
                'stock' => $decreStock
            ]);

            $order = Order::create([
                'invoice' => $data['invoice'],
                'user_id' => $data['user_id'],
                'payment_id' => $data['payment'],
                'address' => $data['address'],
                'payment_proof' => $paymentProof,
                'additional_note' => $data['additional_note'],
                'status' => 'Pesanan Diproses',
                'total' => $data['quantity'] * $product->price,
            ]);

            ListOrder::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $data['quantity'],
                'sub_total' => $data['quantity'] * $product->price,
            ]);

            DB::commit();
            return redirect()->route('user.order.index')->with(
                'success',
                'order telah berhasil dibuat '
            );
        } catch (\Throwable $th) {
            DB::rollBack();

            FileHelper::deleteImage('orders', $data['payment_proof']);

            return back()->with(
                'error',
                'maaf terjadi kesalah sistem ' . $th->getMessage()
            );
        }
    }

    public function storeFromCart(Request $request)
    {
        $data = $request->validate([
            'payment_proof' => 'mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'payment' => 'required',
            'address' => 'required',
            'additional_note' => 'nullable',
        ], [
            'payment_proof.max' => 'maximal 2mb',
            'payment_proof.mimes' => 'invalid bukti pembayaran, bukti pembayaran harus jpeg,png,jpg,gif,svg,webp',
            'payment.required' => 'tidak boleh dikosongkan',
            'address.required' => 'tidak boleh dikosongkan',
        ]);
        $data['invoice'] = Ulid::generate();
        $data['user_id'] = Auth::id();

        $paymentProof = FileHelper::optimizeAndUploadPicture($data['payment_proof'], 'orders');
        $carts = Cart::where('user_id', $data['user_id'])->orderBy('id', 'DESC')->get();

        $error = 1;
        try {
            DB::beginTransaction();
            $totalPrice = 0;
            foreach ($carts as $cart) {
                $stock = $cart->product->stock;
                if ($stock < $cart->quantity) {
                    $error = 2;
                    throw new \Exception($error);
                }
                $cart->product->update([
                    'stock' => $stock - $cart->quantity
                ]);
                $totalPrice = $totalPrice + $cart->total_price;
            }

            $order = Order::create([
                'invoice' => $data['invoice'],
                'user_id' => $data['user_id'],
                'payment_id' => $data['payment'],
                'address' => $data['address'],
                'payment_proof' => $paymentProof,
                'additional_note' => $data['additional_note'],
                'status' => 'Pesanan Diproses',
                'total' => $totalPrice,
            ]);
            // 80k1 sisa 2
            foreach ($carts as $cart) {
                ListOrder::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product->id,
                    'quantity' => $cart->quantity,
                    'sub_total' => $cart->total_price
                ]);
                $cart->delete();
            }

            DB::commit();
            return redirect()->route('user.order.index')->with(
                'success',
                'order telah berhasil dibuat '
            );
        } catch (\Throwable $th) {
            DB::rollBack();

            FileHelper::deleteImage('orders', $data['payment_proof']);

            if ($error == 2) {
                return back()->with(
                    'warning',
                    'maaf quantity anda sudah melebihi stock product, silahkan cek orderan anda kembali dan sesuai kan dengan stock'
                );
            }
            return back()->with(
                'error',
                'maaf terjadi kesalah sistem ' . $th->getMessage()
            );
        }
    }
}
