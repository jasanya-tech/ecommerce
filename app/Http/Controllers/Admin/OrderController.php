<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\ListOrder;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Uid\Ulid;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::filter(request(['search', 'status_filter', 'sort_option']))->paginate(10);
        return view('admin.order.index', compact('orders'));
    }

    public function create()
    {
        $users = User::orderBy('id', 'DESC')->where('role', 2)->get();
        $payments = Payment::orderBy('id', 'DESC')->get();
        $products = Product::orderBy('id', 'DESC')->get();
        return view('admin.order.create', compact('products', 'payments', 'users'));
    }

    public function store(Request $request)
    {
        $selectedProducts = json_decode($request->input('selected_products'), true);
        $newRequest = $request->duplicate(null, $request->all());
        $newRequest->request->set('selected_products', $selectedProducts);
        $data = $newRequest->validate([
            'user_id' => 'required|integer',
            'no_resi' => 'nullable',
            'payment' => 'required|integer',
            'address' => 'required|string',
            'additional_note' => 'string|nullable',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'selected_products' => 'required|array|min:1',
            'selected_products.*.productId' => 'required|integer',
            'selected_products.*.quantity' => 'required|integer|min:1',
            'status' => 'required'
        ]);
        $data['invoice'] = Ulid::generate();
        $paymentProof = FileHelper::optimizeAndUploadPicture($data['payment_proof'], 'orders');

        $total = 0;
        foreach ($newRequest->input('selected_products') as $selectedProduct) {
            $product = Product::where('id', $selectedProduct['productId'])->first();
            if (!$product) {
                return redirect()->route('order.create')
                    ->with('error', 'Terjadi kesalahan. Pesanan tidak berhasil dibuat');
            }
            if ($product->stock < $selectedProduct['quantity']) {
                return redirect()->route('order.create')
                    ->with('warning', 'Stock Product ' . $product->name . ' tersisa ' . $product->stock . ' dan quantity anda melebihi stock product');
            }

            $total = $total + $product->price * $selectedProduct['quantity'];
        }


        try {
            DB::beginTransaction();

            // Buat pesanan baru
            $order = new Order();
            $order->user_id = $request->input('user_id');
            $order->payment_id = $request->input('payment');
            $order->address = $request->input('address');
            $order->additional_note = $request->input('additional_note');
            $order->payment_proof = $paymentProof;
            $order->status = $data['status'];
            $order->invoice = $data['invoice'];
            $order->no_resi = $data['no_resi'];
            $order->total = $total;
            $order->save();

            foreach ($newRequest->input('selected_products') as $selectedProduct) {
                $product = Product::where('id', $selectedProduct['productId'])->first();
                $orderProduct = new ListOrder();
                $orderProduct->order_id = $order->id;
                $orderProduct->product_id = $selectedProduct['productId'];
                $orderProduct->quantity = $selectedProduct['quantity'];
                $orderProduct->sub_total = $product->price * $selectedProduct['quantity'];
                $orderProduct->save();

                $product->update([
                    'stock' => $product->stock - $selectedProduct['quantity']
                ]);
            }

            DB::commit();

            return redirect()->route('order.index')
                ->with('success', 'Pesanan berhasil dibuat');
        } catch (\Exception $e) {
            DB::rollBack();
            FileHelper::deleteImage('orders', $data['payment_proof']);
            return redirect()->route('order.create')
                ->with('error', 'Terjadi kesalahan. Pesanan tidak berhasil dibuat');
        }
    }

    public function show(Order $order)
    {
        return view('admin.order.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $selectedProducts = [];
        foreach ($order->listOrder as $item) {
            $selectedProducts[] = [
                'productId' => $item->product_id,
                'quantity' => $item->quantity,
            ];
        }

        $selectedProductsJSON = json_encode($selectedProducts);

        $users = User::orderBy('id', 'DESC')->where('role', 2)->get();
        $payments = Payment::orderBy('id', 'DESC')->get();
        $products = Product::orderBy('id', 'DESC')->get();
        return view('admin.order.edit', compact('products', 'payments', 'users', 'order', 'selectedProductsJSON'));
    }

    public function update(Request $request, Order $order)
    {
        $selectedProducts = json_decode($request->input('selected_products'), true);
        $newRequest = $request->duplicate(null, $request->all());
        $newRequest->request->set('selected_products', $selectedProducts);
        $data = $newRequest->validate([
            'user_id' => 'required|integer',
            'payment' => 'required|integer',
            'no_resi' => 'nullable',
            'address' => 'required|string',
            'additional_note' => 'string|nullable',
            'payment_proof' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'selected_products' => 'required|array|min:1',
            'selected_products.*.productId' => 'required|integer',
            'selected_products.*.quantity' => 'required|integer|min:1',
            'status' => 'required'
        ]);
        $data['invoice'] = Ulid::generate();

        if ($request->file('payment_proof')) {
            $paymentProof = FileHelper::optimizeAndUploadPicture($data['payment_proof'], 'orders');
        }

        $total = 0;
        foreach ($newRequest->input('selected_products') as $selectedProduct) {
            $product = Product::where('id', $selectedProduct['productId'])->first();
            if (!$product) {
                return redirect()->route('order.create')
                    ->with('error', 'Terjadi kesalahan. Pesanan tidak berhasil dibuat');
            }
            if ($product->stock < $selectedProduct['quantity']) {
                return redirect()->route('order.create')
                    ->with('warning', 'Stock Product ' . $product->name . ' tersisa ' . $product->stock . ' dan quantity anda melebihi stock product');
            }

            $total = $total + $product->price * $selectedProduct['quantity'];
        }

        $oldImage = $order->payment_proof;

        try {
            DB::beginTransaction();

            $order->update([
                'user_id' => $request->input('user_id'),
                'payment_id' => $request->input('payment'),
                'address' => $request->input('address'),
                'additional_note' => $request->input('additional_note'),
                'status' => $data['status'],
                'no_resi' => $data['no_resi'],
                'total' => $total,
            ]);

            if ($request->file('payment_proof')) {
                $order->update([
                    'payment_proof' => $paymentProof,
                ]);
            }

            foreach (ListOrder::where('order_id', $order->id)->get() as $listOrder) {
                $product = Product::where('id', $listOrder->product_id)->first();
                $product->update([
                    'stock' => $product->stock + $listOrder->quantity
                ]);

                $listOrder->delete();
            }

            foreach ($newRequest->input('selected_products') as $selectedProduct) {
                $product = Product::where('id', $selectedProduct['productId'])->first();
                $orderProduct = new ListOrder();
                $orderProduct->order_id = $order->id;
                $orderProduct->product_id = $selectedProduct['productId'];
                $orderProduct->quantity = $selectedProduct['quantity'];
                $orderProduct->sub_total = $product->price * $selectedProduct['quantity'];
                $orderProduct->save();

                $product->update([
                    'stock' => $product->stock - $selectedProduct['quantity']
                ]);
            }

            DB::commit();
            if ($request->file('payment_proof')) {
                FileHelper::deleteImage('orders', $oldImage);
            }
            return redirect()->route('order.edit', $order->id)
                ->with('success', 'Pesanan berhasil diedit');
        } catch (\Exception $e) {
            DB::rollBack();
            if ($request->file('payment_proof')) {
                FileHelper::deleteImage('orders', $data['payment_proof']);
            }
            return redirect()->route('order.edit', $order->id)
                ->with('error', 'Terjadi kesalahan. Pesanan tidak berhasil diedit ' . $e);
        }
    }

    public function destroy(Order $order)
    {
        $oldImage = $order->payment_proof;
        $order->delete();
        FileHelper::deleteImage('orders', $oldImage);

        return redirect()->route('order.index')->with([
            'message' => 'deleted order berhasil',
            'status' => 'success',
        ]);
    }
}
