@extends('layouts.app')

@section('title', 'Add Category | PT ChipiChapa')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="mb-6">
        <a href="/admin/categories" class="text-blue-600 hover:underline text-sm flex items-center mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Categories
        </a>
        <h1 class="text-3xl font-bold text-gray-900">Add New Category</h1>
    </div>

    <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-8">
        <form method="POST" action="/admin/categories" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-1 uppercase tracking-wider">
                    Category Name
                </label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="w-full px-4 py-3 rounded-lg border @error('name') border-red-500 @else border-gray-300 @enderror focus:ring-2 focus:ring-blue-500 outline-none transition"
                    placeholder="e.g., Electronics, Fashion, or Groceries" required autofocus>
                
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-2">
                <button type="submit" 
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg shadow-md hover:shadow-blue-200 transition duration-200 uppercase text-sm tracking-widest">
                    Save Category
                </button>
            </div>
        </form>
    </div>
</div>
@endsection