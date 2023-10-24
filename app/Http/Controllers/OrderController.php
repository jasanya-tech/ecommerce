<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create(Product $product)
    {
        return view('customer.order', [
            'title' => 'order',
            'product' => $product
        ]);
    }

    public function store(Request $request)
    {
        dd($request);
    }

    public function storeFromCart(Request $request)
    {
        dd($request);
    }
}
