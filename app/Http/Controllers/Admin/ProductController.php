<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->filter(request(['search', 'stock_filter', 'sort_option']))->paginate(10);
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        return view('admin.product.create');
    }

    public function store(Request $request)
    {
        $message = $request->validate([
            'name' => 'required|min:4'
        ], [
            'name.required' => 'nama tidak boleh dikosongkan',
            'name.min' => 'minimal karakter 4',
        ]);

        return redirect()->route('product.create')->with([
            'message' => 'created kategori berhasil',
            'status' => 'success',
        ]);
    }

    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('admin.product.update', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $message = $request->validate([
            'name' => 'required|min:4'
        ], [
            'name.required' => 'nama tidak boleh dikosongkan',
            'name.min' => 'minimal karakter 4',
        ]);


        return redirect()->route('product.edit', $product->id)->with([
            'message' => 'updated product berhasil',
            'status' => 'success',
        ]);
    }

    public function destroy(Product $product)
    {
        // $product->delete();
        return back()->with([
            'message' => 'deleted product ' . $product->name . ' berhasil',
            'status' => 'success',
        ]);
    }
}
