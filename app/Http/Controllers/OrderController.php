<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function showDetails()
    {
        $user = Auth::user(); // Mengambil data user
        $cart = Cart::where('user_id', $user->id)->get(); // Ambil data keranjang user
        $total = $cart->sum(function ($item) {
            return $item->harga * $item->jumlah;
        });

        return view('frontend.cart.checkout', compact('cart', 'total', 'user'));
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'no_telp' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);

        $user = Auth::user();
        $user->update([
            'name' => $request->name,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('order.details')->with('success', 'User data updated successfully!');
    }

    public function storeOrder(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'no_telp' => 'required|string|max:15',
        'alamat' => 'required|string',
    ]);

    $user = Auth::user();
    $cart = Cart::where('user_id', $user->id)->get();

    if ($cart->isEmpty()) {
        return redirect()->back()->withErrors(['error' => 'Your cart is empty.']);
    }

    $total = $cart->sum(function ($item) {
        return $item->harga * $item->jumlah;
    });

    // Simpan data order
    $order = Order::create([
        'user_id' => $user->id,
        'name' => $request->name,
        'no_telp' => $request->no_telp,
        'alamat' => $request->alamat,
        'total_amount' => $total,
        'status' => 'pending',
    ]);

    // Simpan item order ke tabel order_items
    foreach ($cart as $item) {
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $item->product_id,
            'quantity' => $item->jumlah,
            'price' => $item->harga,
            'total_price' => $item->harga * $item->jumlah,
        ]);
    }

    // Hapus keranjang setelah pesanan disimpan
    Cart::where('user_id', $user->id)->delete();

    return redirect()->route('order.payment', ['order_id' => $order->id]);
}




}
