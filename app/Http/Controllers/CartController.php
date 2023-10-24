<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->orderBy('id', 'DESC')->get();

        $cartSubtotal = 0; // Inisialisasi subtotal

        foreach ($cartItems as $cartItem) {
            $cartSubtotal += $cartItem->total_price;
        }
        return view('customer.cart', [
            'title' => 'cart',
            'cartItems' => $cartItems,
            'cartSubtotal' => $cartSubtotal,
            'payments' => Payment::all(),
        ]);
    }

    public function store(Request $request, Product $product)
    {
        if ($product->stock <= 0) {
            return back()->with([
                'warning' => 'stock product telah habis',
                'status' => 'warning'
            ]);
        }

        $cartItem = Cart::where('product_id', $product->id)
            ->where('user_id', Auth::id())
            ->first();

        $totalPrice = $product->price * $request->quantity;
        if ($cartItem) {
            $totalQuantity = $cartItem->quantity + $request->quantity;
            if ($totalQuantity > $product->stock) {
                return back()->with([
                    'warning' => 'Jumlah di keranjang melebihi stok produk. Stok tersisa: ' . $product->stock . ' pcs',
                    'status' => 'warning',
                ]);
            }
            $totalPrice = $product->price * $totalQuantity;
            $cartItem->update([
                'quantity' => $totalQuantity,
                'total_price' => $totalPrice
            ]);
        } else {
            if ($request->quantity > $product->stock) {
                return back()->with([
                    'warning' => 'Jumlah yang diminta melebihi stok produk. Stok tersisa: ' . $product->stock . ' pcs',
                    'status' => 'warning',
                ]);
            }
            Cart::create([
                'user_id' => Auth::id(), // Tambahkan user ID
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'total_price' => $totalPrice
            ]);
        }

        return back()->with([
            'success' => 'Produk telah ditambahkan ke keranjang.'
        ]);
    }

    public function update(Request $request, Cart $cart)
    {
        if ($request->quantity <= 0) {
            return back()->with([
                'warning' => 'Minimal harus 1 quantity',
                'status' => 'warning',
            ]);
        }
        if ($cart->product->stock <= 0) {
            return back()->with([
                'warning' => 'stock product telah habis',
                'status' => 'warning'
            ]);
        }

        $totalPrice = $cart->product->price * $request->quantity;
        if ($request->quantity > $cart->product->stock) {
            return back()->with([
                'warning' => 'Jumlah di keranjang melebihi stok produk. Stok tersisa: ' . $cart->product->stock . ' pcs',
                'status' => 'warning',
            ]);
        }


        $cart->update([
            'quantity' => $request->quantity,
            'total_price' => $totalPrice
        ]);


        return back()->with([
            'success' => 'Produk telah diupdate ke keranjang.'
        ]);
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return back()->with([
            'success' => 'Product Berhasil Di hapus dari keranjang.'
        ]);
    }
}
