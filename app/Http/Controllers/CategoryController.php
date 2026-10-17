<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = \App\Models\Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:categories,name'
        ]);

        \App\Models\Category::create([
            'name' => $request->name
        ]);

        return redirect('/admin/categories')->with('success', 'Category added successfully!');
    }

    public function edit($id)
    {
        $category = \App\Models\Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = \App\Models\Category::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255|unique:categories,name,' . $category->id
        ]);

        $category->update([
            'name' => $request->name
        ]);

        return redirect('/admin/categories');
    }

    public function destroy($id)
    {
        \App\Models\Category::destroy($id);
        return redirect('/admin/categories');
    }
}
