@extends('layouts.app')

@section('title', 'Checkout | PT ChipiChapa')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900">Checkout Preview</h1>
        <p class="text-gray-500">Review your items and provide shipping details.</p>
    </div>

    @if(isset($cart) && count($cart) > 0)
    <form method="POST" action="/invoice/save" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        @csrf

        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                <table class="w-full text-left border-collapse" id="cart-table">
                    <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-bold">
                        <tr>
                            <th class="px-6 py-4">Product</th>
                            <th class="px-6 py-4 text-right">Price</th>
                            <th class="px-6 py-4 text-center">Quantity</th>
                            <th class="px-6 py-4 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @php $total = 0; @endphp
                        @foreach($cart as $id => $item)
                        @php
                        $subtotal = $item['price'] * $item['quantity'];
                        $total += $subtotal;
                        @endphp
                        <tr class="hover:bg-gray-50 transition" data-price="{{ $item['price'] }}">
                            <td class="px-6 py-4">
                                <p class="font-bold text-gray-900">{{ $item['name'] }}</p>
                                <p class="text-xs text-gray-500 uppercase">{{ $item['category'] ?? 'General' }}</p>
                            </td>
                            <td class="px-6 py-4 text-right text-gray-600 font-medium">
                                Rp {{ number_format($item['price'], 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <input type="number" name="quantities[{{ $id }}]" value="{{ $item['quantity'] }}"
                                    min="1" class="qty-input w-16 text-center border border-gray-300 rounded-md py-1 focus:ring-2 focus:ring-blue-500 outline-none">
                            </td>
                            <td class="px-6 py-4 text-right font-bold text-blue-700 subtotal-cell">
                                Rp {{ number_format($subtotal, 0, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white border border-gray-200 rounded-xl shadow-md p-6 sticky top-24">
                <h3 class="text-lg font-bold text-gray-900 mb-4 border-b pb-2">Shipping Information</h3>

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Delivery Address</label>
                        <textarea name="address" rows="3" required
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none transition text-sm"
                            placeholder="Enter full address (10-100 characters)">{{ old('address') }}</textarea>
                        <p class="text-[10px] text-gray-400 mt-1 uppercase italic">10-100 characters</p>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Postal Code</label>
                        <input type="text" name="postal_code" value="{{ old('postal_code') }}" required
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none transition text-sm"
                            placeholder="e.g. 12345">
                        <p class="text-[10px] text-gray-400 mt-1 uppercase italic">5 Digits required</p>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <span class="text-gray-600 font-medium">Grand Total</span>
                        <span class="text-2xl font-black text-blue-700" id="grand-total">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </span>
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-extrabold py-4 rounded-xl shadow-lg hover:shadow-blue-200 transition duration-200 uppercase tracking-widest text-sm">
                        Place Order
                    </button>
                </div>
            </div>
        </div>
    </form>

    <script>
        document.querySelectorAll('.qty-input').forEach(input => {
            input.addEventListener('input', function() {
                const row = this.closest('tr');
                const price = parseFloat(row.dataset.price);
                const quantity = parseInt(this.value) || 0;
                const subtotalCell = row.querySelector('.subtotal-cell');

                const subtotal = price * quantity;
                subtotalCell.textContent = 'Rp ' + subtotal.toLocaleString('id-ID');

                let total = 0;
                document.querySelectorAll('.subtotal-cell').forEach(cell => {
                    const value = parseInt(cell.textContent.replace(/[^\d]/g, '')) || 0;
                    total += value;
                });
                document.getElementById('grand-total').textContent = 'Rp ' + total.toLocaleString('id-ID');
            });
        });
    </script>

    @else
    <div class="text-center py-20 bg-white rounded-2xl border border-dashed border-gray-300">
        <div class="text-gray-400 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
            </svg>
        </div>
        <h2 class="text-xl font-bold text-gray-900">Your cart is empty</h2>
        <p class="text-gray-500 mb-6">Looks like you haven't added anything to your cart yet.</p>
        <a href="/products" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-bold hover:bg-blue-700 transition shadow-md">
            Go to Catalog
        </a>
    </div>
    @endif
</div>
@endsection