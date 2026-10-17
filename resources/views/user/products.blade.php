@extends('layouts.app')

@section('title', 'Product Catalog | PT ChipiChapa')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="mb-10 text-center">
        <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">Store Catalog</h1>
        <p class="mt-2 text-lg text-gray-500">Quality goods for your everyday needs, curated by PT ChipiChapa.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @foreach($products as $p)
        <div class="group bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col overflow-hidden">
            
            <div class="aspect-square w-full bg-gray-100 overflow-hidden relative">
                @if($p->image)
                    <img src="{{ asset('storage/' . $p->image) }}" alt="{{ $p->name }}" 
                         class="h-full w-full object-cover group-hover:scale-110 transition-transform duration-500">
                @else
                    <div class="h-full w-full flex items-center justify-center text-gray-400 italic text-xs">No Image Available</div>
                @endif

                <div class="absolute top-3 left-3">
                    <span class="px-2 py-1 bg-white/90 backdrop-blur-sm text-[10px] font-bold text-blue-700 rounded-md shadow-sm uppercase tracking-wider">
                        {{ $p->category->name ?? 'General' }}
                    </span>
                </div>
            </div>

            <div class="p-6 flex-grow flex flex-col">
                <h3 class="text-lg font-bold text-gray-900 mb-1 group-hover:text-blue-600 transition-colors">
                    {{ $p->name }}
                </h3>
                
                <div class="flex items-baseline space-x-2 mb-4">
                    <span class="text-xl font-black text-gray-900">
                        Rp {{ number_format($p->price, 0, ',', '.') }}
                    </span>
                </div>

                <div class="mt-auto">
                    <div class="flex items-center justify-between mb-4 text-sm">
                        <span class="text-gray-500">Available Stock:</span>
                        <span class="font-bold {{ $p->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $p->stock }}
                        </span>
                    </div>

                    @if($p->stock > 0)
                        <form method="POST" action="/add-to-cart/{{ $p->id }}">
                            @csrf
                            <button type="submit" 
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl shadow-lg hover:shadow-blue-200 transition duration-200 flex items-center justify-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                <span>Add to Invoice</span>
                            </button>
                        </form>
                    @else
                        <div class="w-full bg-gray-100 text-gray-400 font-bold py-3 rounded-xl text-center cursor-not-allowed italic text-sm border border-gray-200">
                            This product is currently out of stock. Please wait until it is restocked.
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($products->isEmpty())
    <div class="text-center py-20 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
        <p class="text-gray-500 font-medium">No products found in the catalog.</p>
    </div>
    @endif
</div>
@endsection