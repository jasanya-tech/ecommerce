<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->filter(request(['search', 'stock_filter', 'sort_option']))->get();
        $categories = Category::all();
        return view('customer.product.index', [
            'title' => 'product',
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function indexByCategory(Category $category)
    {
        $products = Product::latest()->filter(request(['search', 'stock_filter', 'sort_option']))->where('category_id', $category->id)->paginate(10);
        $categories = Category::all();
        return view('customer.product.index', [
            'title' => 'product',
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function show(Product $product)
    {
        $product->with('image');
        return view('customer.product.detail', [
            'title' => $product->name,
            'product' => $product
        ]);
    }
}
