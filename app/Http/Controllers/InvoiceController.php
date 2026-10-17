<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (!$cart || count($cart) == 0) {
            return back()->with('error', 'Cart is empty');
        }

        $request->validate([
            'address' => 'required|min:10|max:100',
            'postal_code' => 'required|digits:5',
            'quantities' => 'required|array',
            'quantities.*' => 'required|integer|min:1'
        ]);

        $quantities = $request->quantities;
        $total_invoice_price = 0;

        DB::beginTransaction();

        try {
            do {
                $invoiceNumber = 'INV-' . date('Ymd') . '-' . rand(100, 999);
            } while (Invoice::where('invoice_number', $invoiceNumber)->exists());
            $invoice = Invoice::create([
                'invoice_number' => $invoiceNumber,
                'user_id' => Auth::id(),
                'address' => $request->address,
                'postal_code' => $request->postal_code,
                'total_price' => 0
            ]);

            foreach ($cart as $productId => $item) {
                $product = Product::findOrFail($productId);
                $orderQuantity = intval($quantities[$productId] ?? $item['quantity']);

                $subtotal = $product->price * $orderQuantity;

                if ($product->stock < $orderQuantity) {
                    DB::rollBack();
                    return back()->with('error', "Barang sudah habis, silakan tunggu hingga barang di-restock ulang.");
                }

                $subtotal = $product->price * $orderQuantity;
                $total_invoice_price += $subtotal;

                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'product_id' => $productId,
                    'quantity' => $orderQuantity,
                    'subtotal' => $subtotal
                ]);

                $product->stock -= $orderQuantity;
                $product->save();
            }

            $invoice->update(['total_price' => $total_invoice_price]);

            DB::commit();
            session()->forget('cart');

            return redirect()->route('invoice.show', $invoice->id)
                ->with('success', "Invoice $invoiceNumber created successfully!");
        } catch (\Exception $e) {
            DB::rollBack();
            report($e); // writes the real error to storage/logs/laravel.log
            return back()->with('error', 'Something went wrong while processing your order. Please try again.');
        }
    }

    public function show($id)
    {
        $invoice = Invoice::with(['items.product.category', 'user'])->findOrFail($id);

        return view('invoices.show', compact('invoice'));
    }
}
