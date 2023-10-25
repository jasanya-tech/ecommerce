<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index()
    {
        $users = User::where('role', 2)->count();
        $orders = Order::count();
        $products = Product::count();
        $categories = Category::count();
        return view('admin.dashboard', compact('users', 'orders', 'products', 'categories'));
    }
}
