<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Stok tidak mencukupi.');
        }

        $total = $product->price * $request->quantity;

        Order::create([
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'total_price' => $total,
        ]);

        $product->decrement('stock', $request->quantity);

        return back()->with('success', 'Pesanan berhasil dibuat.');
    }
}


