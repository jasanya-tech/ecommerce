<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        $product->with('image');
        return view('customer.productDetail', [
            'title' => $product->name,
            'product' => $product
        ]);
    }
}
