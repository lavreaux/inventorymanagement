@extends('layouts.app')

@section('title', 'Edit Product | PT ChipiChapa')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="/admin/products" class="text-blue-600 hover:underline text-sm flex items-center mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Inventory
        </a>
        <h1 class="text-3xl font-bold text-gray-900">Edit Product</h1>
        <p class="text-gray-500 text-sm">Update the details for <span class="text-blue-600 font-semibold">{{ $product->name }}</span></p>
    </div>

    <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-8">
        <form method="POST" action="/admin/products/{{ $product->id }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Barang</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" 
                    class="w-full px-4 py-3 rounded-lg border @error('name') border-red-500 @else border-gray-300 @enderror focus:ring-2 focus:ring-blue-500 outline-none transition"
                    required>
                <p class="text-[10px] text-gray-400 mt-1 uppercase italic">5-80 characters</p>
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Kategori Barang</label>
                    <select name="category_id" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none bg-white transition">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ (old('category_id', $product->category_id) == $cat->id) ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Harga Barang</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3 text-gray-400 font-medium">Rp.</span>
                        <input type="number" name="price" value="{{ old('price', $product->price) }}" 
                            class="w-full pl-12 pr-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none transition"
                            required>
                    </div>
                    @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Jumlah Barang (Stock)</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" 
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none transition"
                    required>
                @error('stock') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Barang</label>
                <div class="flex items-center space-x-6 p-4 border border-gray-100 rounded-lg bg-gray-50">
                    <div class="shrink-0 text-center">
                        <p class="text-[10px] text-gray-400 uppercase mb-1">Current Image</p>
                        <img class="h-20 w-20 object-cover rounded-lg ring-2 ring-white shadow-sm" 
                             src="{{ asset('storage/' . $product->image) }}" 
                             alt="Current product photo">
                    </div>
                    <label class="block w-full">
                        <span class="sr-only">Choose new photo</span>
                        <input type="file" name="image" 
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer"/>
                        <p class="mt-2 text-xs text-gray-400 italic">Leave empty to keep the current image.</p>
                    </label>
                </div>
                @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="pt-4">
                <button type="submit" 
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-blue-200 transition duration-200 uppercase tracking-wider">
                    Update Inventory Item
                </button>
            </div>
        </form>
    </div>
</div>
@endsection