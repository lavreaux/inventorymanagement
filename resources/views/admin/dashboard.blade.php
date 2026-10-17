@extends('layouts.app')

@section('title', 'Admin Dashboard | ChipiChapa')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
        <p class="text-gray-500">Welcome back, <span class="font-semibold text-blue-600">{{ Auth::user()->name }}</span></p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="/admin/products" class="group p-6 bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md hover:border-blue-300 transition duration-200">
            <div class="flex items-center space-x-4">
                <div class="p-3 bg-blue-50 text-blue-600 rounded-lg group-hover:bg-blue-600 group-hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 11v10l8 4" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Manage Products</h3>
                    <p class="text-sm text-gray-500">Create, Update, and Delete inventory items.</p>
                </div>
            </div>
        </a>

        <a href="/admin/categories" class="group p-6 bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md hover:border-blue-300 transition duration-200">
            <div class="flex items-center space-x-4">
                <div class="p-3 bg-purple-50 text-purple-600 rounded-lg group-hover:bg-purple-600 group-hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Manage Categories</h3>
                    <p class="text-sm text-gray-500">Organize goods by their specific categories.</p>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection