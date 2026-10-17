@extends('layouts.app')

@section('title', 'Manage Categories | PT ChipiChapa')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Product Categories</h1>
            <p class="text-gray-500 text-sm">Organize your inventory with specific labels</p>
        </div>
        <a href="/admin/categories/create" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-white hover:bg-blue-700 transition shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add New Category
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-bold">
                <tr>
                    <th class="px-6 py-4">Category Name</th>
                    <th class="px-6 py-4 text-center">Total Products</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($categories as $cat)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-medium text-gray-900">
                        {{ $cat->name }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $cat->products_count ?? $cat->products->count() }} Items
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end space-x-3">
                            <a href="/admin/categories/{{ $cat->id }}/edit" class="text-blue-600 hover:text-blue-800 font-semibold text-sm transition">
                                Edit
                            </a>
                            <form method="POST" action="/admin/categories/{{ $cat->id }}" onsubmit="return confirm('Deleting this category may affect linked products. Continue?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-semibold text-sm transition">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-10 text-center text-gray-500 italic">
                        No categories found. Start by adding one!
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection