@extends('layouts.app')

@section('title', 'Invoice #' . $invoice->invoice_number)

@section('content')
<div class="max-w-3xl mx-auto my-8">
    <div class="flex justify-between items-center mb-6 print:hidden">
        <a href="/products" class="text-blue-600 hover:underline flex items-center text-sm font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Catalog
        </a>
        <button onclick="window.print()" class="bg-gray-800 hover:bg-black text-white px-6 py-2 rounded-lg font-bold shadow-md transition flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4" />
            </svg>
            Print Faktur
        </button>
    </div>

    <div class="bg-white border border-gray-200 shadow-lg rounded-xl overflow-hidden p-8 sm:p-12" id="invoice-card">
        <div class="flex flex-col sm:flex-row justify-between items-start mb-10 border-b border-gray-100 pb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-blue-700 tracking-tight">PT CHIPICHAPA</h1>
                <p class="text-gray-500 text-sm mt-1 uppercase tracking-widest font-medium">Official Invoice</p>
            </div>
            <div class="mt-4 sm:mt-0 text-right">
                <p class="text-sm font-bold text-gray-900">Invoice No: <span class="text-blue-600">#{{ $invoice->invoice_number }}</span></p>
                <p class="text-xs text-gray-500 mt-1 italic">{{ $invoice->created_at->format('d F Y, H:i') }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
            <div>
                <h3 class="text-xs font-bold text-gray-400 uppercase mb-2 tracking-widest">Customer Details</h3>
                <p class="text-gray-900 font-bold text-lg">{{ $invoice->user->name }}</p>
                <p class="text-gray-600 text-sm">{{ $invoice->user->email }}</p>
                <p class="text-gray-600 text-sm">{{ $invoice->user->phone ?? 'No Phone' }}</p>
            </div>
            <div class="md:text-right">
                <h3 class="text-xs font-bold text-gray-400 uppercase mb-2 tracking-widest">Shipping Address</h3>
                <p class="text-gray-900 font-medium leading-relaxed">{{ $invoice->address }}</p>
                <p class="text-gray-900 font-bold mt-1">Kode Pos: {{ $invoice->postal_code }}</p>
            </div>
        </div>

        <div class="mb-10">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b-2 border-gray-100">
                        <th class="py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Item / Category</th>
                        <th class="py-4 text-right text-xs font-bold text-gray-400 uppercase tracking-wider">Price</th>
                        <th class="py-4 text-center text-xs font-bold text-gray-400 uppercase tracking-wider">Qty</th>
                        <th class="py-4 text-right text-xs font-bold text-gray-400 uppercase tracking-wider">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @php $runningTotal = 0; @endphp
                    @foreach($invoice->items as $item)
                    @php
                    $rowSubtotal = $item->subtotal; // price at time of purchase
                    $unitPrice = $item->quantity > 0 ? $rowSubtotal / $item->quantity : 0;
                    $runningTotal += $rowSubtotal;
                    @endphp
                    <tr>
                        <td class="py-4">
                            <span class="font-bold text-gray-900">{{ $item->product->name }}</span><br>
                            <span class="text-[10px] uppercase text-gray-400">{{ $item->product->category->name ?? 'General' }}</span>
                        </td>
                        <td class="py-4 text-right">Rp {{ number_format($unitPrice, 0, ',', '.') }}</td>
                        <td class="py-4 text-center">{{ $item->quantity }}</td>
                        <td class="py-4 text-right font-bold text-gray-900">
                            Rp {{ number_format($rowSubtotal, 0, ',', '.') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex justify-end border-t-2 border-gray-100 pt-6">
            <div class="w-full sm:w-64 space-y-3">
                <div class="flex justify-between text-gray-500">
                    <span>Subtotal</span>
                    <span>Rp {{ number_format($runningTotal, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-gray-500">
                    <span>Tax (0%)</span>
                    <span>Rp 0</span>
                </div>
                <div class="flex justify-between border-t border-gray-100 pt-3 text-xl font-extrabold text-blue-700">
                    <span>TOTAL</span>
                    <span>Rp {{ number_format($invoice->total_price > 0 ? $invoice->total_price : $runningTotal, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <div class="mt-16 text-center text-gray-400 text-[10px] uppercase tracking-widest border-t border-gray-50 pt-8">
            Thank you for shopping at PT ChipiChapa Retail
        </div>
    </div>
</div>

<style>
    @media print {
        body {
            background: white !important;
        }

        nav,
        footer,
        .print\:hidden {
            display: none !important;
        }

        #invoice-card {
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
        }
    }
</style>
@endsection