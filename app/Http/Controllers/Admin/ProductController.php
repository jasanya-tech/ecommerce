<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\ImageProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        $data = $request->validate([
            'name' => 'required|min:4',
            'stock' => 'required|min:0|max:1000',
            'price' => 'required|min:0|max:1000000000',
            'thumbnail' => 'required|max:150',
            'description' => 'required',
            'image' => 'required|array|max:10',
            'image.*' => 'mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ], [
            'name.required' => 'nama tidak boleh dikosongkan',
            'name.min' => 'minimal karakter 4',
            'stock.required' => 'tidak boleh dikosongkan',
            'stock.min' => 'minimal 0',
            'stock.max' => 'maximal 1000',
            'price.min' => 'minimal 0',
            'price.required' => 'tidak boleh dikosongkan',
            'price.max' => 'maximal 1000000000',
            'thumbnail.min' => 'maximal karakter 150',
            'thumbnail.required' => 'tidak boleh dikosongkan',
            'description.required' => 'tidak boleh dikosongkan',
            'image.required' => 'tidak boleh dikosongkan',
            'image.array' => 'invalid request',
            'image.max' => 'maximal 10 image',
            'image.*.max' => 'maximal 2mb',
            'image.*.mimes' => 'invalid image, image harus jpeg,png,jpg,gif,svg,webp',
        ]);

        try {
            DB::beginTransaction();

            $product = Product::create($data);

            $images = [];
            for ($i = 0; $i < count($data['image']); $i++) {
                $data['image'][$i] = FileHelper::optimizeAndUploadPicture($data['image'][$i], 'products/' . $data['name']);
                $images[$i] = [
                    'image' => $data['image'][$i],
                    'product_id' => $product->id
                ];
            }

            foreach ($images as $image) {
                ImageProduct::create($image);
            }

            DB::commit();
            return redirect()->route('product.create')->with([
                'message' => 'created product berhasil',
                'status' => 'success',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            Storage::deleteDirectory('products/' . $data['name']);

            return redirect()->route('product.create')->with([
                'message' => 'created product gagal',
                'status' => 'danger',
            ]);
        }
    }

    public function show(Product $product)
    {
        $product->with('image');
        return view('admin.product.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('admin.product.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|min:4',
            'stock' => 'required|min:0|max:1000',
            'price' => 'required|min:0|max:1000000000',
            'thumbnail' => 'required|max:150',
            'description' => 'required',
            'image' => 'required|array|max:10',
            'image.*' => 'mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ], [
            'name.required' => 'nama tidak boleh dikosongkan',
            'name.min' => 'minimal karakter 4',
            'stock.required' => 'tidak boleh dikosongkan',
            'stock.min' => 'minimal 0',
            'stock.max' => 'maximal 1000',
            'price.min' => 'minimal 0',
            'price.required' => 'tidak boleh dikosongkan',
            'price.max' => 'maximal 1000000000',
            'thumbnail.min' => 'maximal karakter 150',
            'thumbnail.required' => 'tidak boleh dikosongkan',
            'description.required' => 'tidak boleh dikosongkan',
            'image.required' => 'tidak boleh dikosongkan',
            'image.array' => 'invalid request',
            'image.max' => 'maximal 10 image',
            'image.*.max' => 'maximal 2mb',
            'image.*.mimes' => 'invalid image, image harus jpeg,png,jpg,gif,svg,webp',
        ]);

        $oldName = $product->name;
        Storage::move('public/products/' . $oldName, 'public/products/' . $oldName . '-old');

        try {
            DB::beginTransaction();

            $product->update($data);

            $images = [];
            for ($i = 0; $i < count($data['image']); $i++) {
                $data['image'][$i] = FileHelper::optimizeAndUploadPicture($data['image'][$i], 'products/' . $data['name']);
                $images[$i] = [
                    'image' => $data['image'][$i],
                    'product_id' => $product->id
                ];
            }

            ImageProduct::where('product_id', $product->id)->delete();
            foreach ($images as $image) {
                ImageProduct::create($image);
            }
            DB::commit();
            Storage::deleteDirectory('public/products/' . $oldName . '-old');
            return redirect()->route('product.edit', $product->id)->with([
                'message' => 'updated product berhasil',
                'status' => 'success',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            Storage::deleteDirectory('public/products/' . $data['name']);
            Storage::move('public/products/' . $oldName . '-old', 'public/products/' . $oldName);
            return redirect()->route('product.edit', $product->id)->with([
                'message' => 'updated product gagal',
                'status' => 'danger',
            ]);
        }
    }

    public function destroy(Product $product)
    {
        $product->delete();
        Storage::deleteDirectory('products/' . $product->name);
        return redirect()->route('product.index')->with([
            'message' => 'deleted product ' . $product->name . ' berhasil',
            'status' => 'success',
        ]);
    }
}
