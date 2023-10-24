<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        return view('customer.cart');
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
}
