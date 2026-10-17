@extends('layouts.app')

@section('title', 'Add New Product | PT ChipiChapa')

@section('content')
<div class="max-w-2xl mx-auto py-10 min-h-[80vh]">
    <div class="mb-6">
        <a href="/admin/products" class="text-blue-600 hover:underline text-sm flex items-center mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Inventory
        </a>
        <h1 class="text-3xl font-bold text-gray-900">Add New Product</h1>
    </div>

    <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-8">
        <form method="POST" action="/admin/products" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Barang</label>
                <input type="text" name="name" value="{{ old('name') }}" 
                    class="w-full px-4 py-3 rounded-lg border @error('name') border-red-500 @else border-gray-300 @enderror focus:ring-2 focus:ring-blue-500 outline-none transition"
                    placeholder="Minimal 5, Maksimal 80 huruf" required>
                <p class="text-[10px] text-gray-400 mt-1 uppercase italic">5-80 characters</p>
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Kategori Barang</label>
                    <select name="category_id" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none bg-white transition">
                        <option value="" disabled selected>Select Category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Harga Barang</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3 text-gray-400 font-medium">Rp.</span>
                        <input type="number" name="price" value="{{ old('price') }}" 
                            class="w-full pl-12 pr-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none transition"
                            placeholder="0" required>
                    </div>
                    @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Jumlah Barang (Stock)</label>
                <input type="number" name="stock" value="{{ old('stock') }}" 
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none transition"
                    placeholder="Enter quantity in digits" required>
                @error('stock') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Foto Barang</label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-blue-400 transition">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="text-sm text-gray-600">
                            <label for="image" class="relative cursor-pointer font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                <span>Upload a file</span>
                                <input id="image" name="image" type="file" class="hidden" required onchange="updateFileName(this)">
                            </label>
                        </div>
                        <p id="file-name" class="text-xs text-blue-500 mt-2 font-bold uppercase"></p>
                        <p class="text-xs text-gray-500">PNG, JPG up to 10MB</p>
                    </div>
                </div>
                @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="pt-4">
                <button type="submit" 
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-blue-200 transition duration-200 uppercase tracking-wider">
                    Add to ChipiChapa Inventory
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function updateFileName(input) {
        const fileName = input.files[0].name;
        document.getElementById('file-name').textContent = "Selected: " + fileName;
    }
</script>
@endsection