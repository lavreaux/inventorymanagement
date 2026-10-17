<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class UserProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('user.products', compact('products'));
    }

    public function addToCart($id)
    {
        $product = Product::with('category')->findOrFail($id);

        if ($product->stock <= 0) {
            return back()->with('error', 'Barang sudah habis');
        }

        $cart = session()->get('cart', []);

        $cart[$id] = [
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => ($cart[$id]['quantity'] ?? 0) + 1,
            'category' => $product->category->name ?? 'Uncategorized'
        ];


        session()->put('cart', $cart);

        return back()->with('success', 'Added to cart');
    }

    public function viewCart()
    {
        $cart = session()->get('cart', []);
        $invoiceNumber = 'INV-' . date('Ymd') . '-' . rand(100, 999);

        return view('user.cart', compact('cart', 'invoiceNumber'));
    }
}
