<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('customer.home', [
            'title' => 'home',
            'products' => Product::latest()->filter(request(['search', 'stock_filter', 'sort_option']))->paginate(10)
        ]);
    }
}
