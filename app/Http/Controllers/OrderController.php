<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
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
        $data = $request->validate([
            'payment_proof' => 'mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ], [
            'payment_proof.max' => 'maximal 2mb',
            'payment_proof.mimes' => 'invalid bukti pembayaran, bukti pembayaran harus jpeg,png,jpg,gif,svg,webp',
        ]);

        return back()->with(
            'warning',
            'invalid '
        );
    }

    public function storeFromCart(Request $request)
    {
        $data = $request->validate([
            'payment_proof' => 'mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ], [
            'payment_proof.max' => 'maximal 2mb',
            'payment_proof.mimes' => 'invalid bukti pembayaran, bukti pembayaran harus jpeg,png,jpg,gif,svg,webp',
        ]);

        return back()->with(
            'warning',
            'invalid '
        );
    }
}
