@extends('layouts.app')

@section('title', 'Inventory Management | PT ChipiChapa')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="p-6 border-b border-gray-200 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Product Inventory</h1>
            <p class="text-sm text-gray-500">Manage your retail stock and pricing</p>
        </div>
        <a href="/admin/products/create" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-white hover:bg-blue-700 transition shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add New Product
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-bold">
                <tr>
                    <th class="px-6 py-4">Image</th>
                    <th class="px-6 py-4">Product Name</th>
                    <th class="px-6 py-4">Category</th>
                    <th class="px-6 py-4">Price</th>
                    <th class="px-6 py-4 text-center">Stock</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($products as $p)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">
                        <div class="h-16 w-16 rounded-lg border border-gray-200 overflow-hidden bg-gray-100">
                            @if($p->image)
                                <img src="{{ asset('storage/' . $p->image) }}" alt="{{ $p->name }}" class="h-full w-full object-cover">
                            @else
                                <div class="h-full w-full flex items-center justify-center text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-900">{{ $p->name }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-full border border-gray-200">
                            {{ $p->category->name ?? 'Uncategorized' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 font-medium text-blue-700">
                        Rp {{ number_format($p->price, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="{{ $p->stock <= 5 ? 'text-red-600 font-bold' : 'text-gray-600' }}">
                            {{ $p->stock }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end space-x-2">
                            <a href="/admin/products/{{ $p->id }}/edit" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <form action="/admin/products/{{ $p->id }}" method="POST" onsubmit="return confirm('Delete this product from ChipiChapa inventory?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-10 text-center text-gray-500 italic">
                        No products found in the database.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection