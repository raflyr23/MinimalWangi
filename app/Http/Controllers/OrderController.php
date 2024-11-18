<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    public function showDetails()
{
    $user = Auth::user();
    $cart = Cart::where('user_id', $user->id)->get();
    $total = $cart->sum(function ($item) {
        return $item->harga * $item->jumlah;
    });

    return view('frontend.cart.checkout', compact('cart', 'total', 'user'));
}

    public function __construct()
    {
        // Pastikan Anda sudah mengonfigurasi Midtrans dengan benar
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function checkout(Request $request)
    {
        // Ambil data pengguna dan keranjang
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->get();
        $total = $cart->sum(function ($item) {
            return $item->harga * $item->jumlah;
        });

        return view('frontend.cart.checkout', compact('cart', 'total', 'user'));
    }

    public function confirmOrder(Request $request)
    {
        // Ambil data pengguna dan keranjang
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->get();
        $total = $cart->sum(function ($item) {
            return $item->harga * $item->jumlah;
        });

        // Simpan order ke database
        $order = Order::create([
            'user_id' => $user->id,
            'total_amount' => $total,
            'status' => 'pending',
        ]);

        // Simpan order items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->jumlah,
                'price' => $item->harga,
                'total_price' => $item->harga * $item->jumlah,
            ]);
        }

        // Persiapkan data untuk transaksi Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $order->id,
                'gross_amount' => $total,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
                'phone' => $user->no_telp,
            ],
            'item_details' => $cart->map(function ($item) {
                return [
                    'id' => $item->product_id,
                    'price' => $item->harga,
                    'quantity' => $item->jumlah,
                    'name' => $item->nama_produk,
                ];
            })->toArray(),
        ];

        // Mendapatkan Snap token
        $snapToken = Snap::getSnapToken($params);

        // Hapus keranjang setelah transaksi
        Cart::where('user_id', $user->id)->delete();

        // Kembalikan token Snap untuk digunakan di frontend
        return view('frontend.cart.midtrans_checkout', [
            'snapToken' => $snapToken,
            'order' => $order,
            'clientKey' => config('midtrans.client_key'),
        ]);
    }

    public function updateOrder(Request $request)
{
    try {
        DB::beginTransaction();

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'no_telp' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);

        // Ambil user yang sedang login
        $user = Auth::user();

        // Update data user
        $user->update([
            'name' => $request->name,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ]);

        // Ambil keranjang pengguna
        $cart = Cart::where('user_id', $user->id)->get();
        if ($cart->isEmpty()) {
            throw new \Exception('Cart is empty.');
        }

        // Hitung total harga
        $total = $cart->sum(function ($item) {
            return $item->harga * $item->jumlah;
        });

        // Simpan data order
        $order = Order::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'no_hp' => $user->no_telp,
            'alamat' => $user->alamat,
            'total_amount' => $total,
            'payment_status' => 'pending',
            'delivery_status' => 'pending',
        ]);

        // Simpan item-item dalam order
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->jumlah,
                'price' => $item->harga,
                'total_price' => $item->harga * $item->jumlah,
            ]);
        }

        // Hapus keranjang setelah order dibuat
        Cart::where('user_id', $user->id)->delete();

        DB::commit();

        return redirect()->route('order.success', ['order' => $order]);

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors(['error' => 'Error: ' . $e->getMessage()]);
    }
}

}
