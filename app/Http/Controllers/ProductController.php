<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = \App\Models\Product::with('category')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5|max:80',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'category_id' => 'required',
            'image' => 'required|image'
        ]);

        $imagePath = $request->file('image')->store('products', 'public');

        \App\Models\Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'image' => $imagePath
        ]);

        return redirect('/admin/products')->with('success', 'Product added successfully');
    }

    public function edit($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        $categories = \App\Models\Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = \App\Models\Product::findOrFail($id);

        $request->validate([
            'name' => 'required|min:5|max:80',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'category_id' => 'required',
            'image' => 'nullable|image'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->category_id = $request->category_id;

        $product->save();

        return redirect('/admin/products')->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        \App\Models\Product::destroy($id);
        return redirect('/admin/products')->with('success', 'Product deleted successfully');
    }
}
