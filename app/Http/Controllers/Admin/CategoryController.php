<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->filter(request(['search']))->paginate(10);
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $message = $request->validate([
            'name' => 'required|min:4'
        ], [
            'name.required' => 'nama tidak boleh dikosongkan',
            'name.min' => 'minimal karakter 4',
        ]);

        Category::create([
            'name' => $message['name'],
        ]);

        return redirect()->route('category.create')->with([
            'message' => 'created kategori berhasil',
            'status' => 'success',
        ]);
    }

    public function edit(Category $category)
    {
        return view('admin.category.update', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $message = $request->validate([
            'name' => 'required|min:4'
        ], [
            'name.required' => 'nama tidak boleh dikosongkan',
            'name.min' => 'minimal karakter 4',
        ]);

        $category->update([
            'name' => $message['name']
        ]);

        return redirect()->route('category.edit', $category->id)->with([
            'message' => 'updated kategori berhasil',
            'status' => 'success',
        ]);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with([
            'message' => 'deleted kategori ' . $category->name . ' berhasil',
            'status' => 'success',
        ]);
    }
}
