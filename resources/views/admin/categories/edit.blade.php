@extends('layouts.app')

@section('title', 'Edit Category | PT ChipiChapa')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="mb-6">
        <a href="/admin/categories" class="text-blue-600 hover:underline text-sm flex items-center mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Categories
        </a>
        <h1 class="text-3xl font-bold text-gray-900">Edit Category</h1>
    </div>

    <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-8">
        <form method="POST" action="/admin/categories/{{ $category->id }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1 text-xs uppercase tracking-wider">Category Name</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" 
                    class="w-full px-4 py-3 rounded-lg border @error('name') border-red-500 @else border-gray-300 @enderror focus:ring-2 focus:ring-blue-500 outline-none transition"
                    placeholder="e.g., Electronics, Food, etc." required>
                
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center space-x-4 pt-2">
                <button type="submit" 
                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg shadow-md hover:shadow-blue-200 transition duration-200 uppercase text-sm tracking-widest">
                    Update Category
                </button>
                <a href="/admin/categories" class="px-6 py-3 border border-gray-300 text-gray-600 font-semibold rounded-lg hover:bg-gray-50 transition text-sm">
                    Cancel
                </a>
            </div>
        </form>
    </div>

    <div class="mt-8 p-4 bg-amber-50 border border-amber-100 rounded-lg">
        <div class="flex">
            <svg class="h-5 w-5 text-amber-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            <p class="text-xs text-amber-700">
                <strong>Important:</strong> Changing a category name will immediately update the labels on all items currently linked to it.
            </p>
        </div>
    </div>
</div>
@endsection