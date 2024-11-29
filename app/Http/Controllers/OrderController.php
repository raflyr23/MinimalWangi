<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Order;
use App\Models\order_detail;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Review;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Auth::user()->orders()->with(['orderDetails.product'])->get(); // Ambil data order milik user (sesuaikan logika ini)
        return view('frontend.home.order', compact('orders'));
    }
    public function showDetails()
    {
        $user = Auth::user(); // Mengambil data user
        $cart = Cart::where('user_id', $user->id)->get(); // Ambil data keranjang user
        $total = $cart->sum(function ($item) {
            return $item->harga * $item->jumlah;
        });

        return view('frontend.cart.checkout', compact('cart', 'total', 'user'));
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

   
}

public function add_order(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'no_telp' => 'required|string|max:15',
        'alamat' => 'required|string',
        'image' => 'required|mimes:jpg,jpeg,png|max:2048',
    ]);

    if (!Auth::check()) {
        return redirect('login')->with('error', 'Please login to complete your order.');
    }

    $user = Auth::user();
    $cart = Cart::where('user_id', $user->id)->get();

    if ($cart->isEmpty()) {
        return redirect()->back()->withErrors(['error' => 'Your cart is empty.']);
    }

    $total = $cart->sum(function ($item) {
        return $item->harga * $item->jumlah;
    });

    // Create a new order
    $orders = new Order();
    $orders->name = $request->name; // Data dari input
    $orders->email = $user->email; // Email tetap dari akun
    $orders->no_hp = $request->no_telp; // Data dari input
    $orders->alamat = $request->alamat; // Data dari input
    $orders->user_id = $user->id;

    // Handle image upload for proof of payment
    $image = $request->file('image');
    $imagename = time() . '.' . $image->getClientOriginalExtension();
    $image->move(public_path('uploads/payments'), $imagename);
    $orders->bukti_pembayaran = $imagename;

    $orders->payment_status = 'Pending';
    $orders->delivery_status = '';
    $orders->save();

    // Add order details for each item in the cart
    foreach ($cart as $item) {
        $order_details = new order_detail();
        $order_details->order_id = $orders->id;
        $order_details->nama_produk = $item->nama_produk;
        $order_details->jumlah = $item->jumlah;
        $order_details->harga = $item->harga;
        $order_details->product_id = $item->product_id; // assuming 'product_id' exists in the Cart model
        $order_details->save();
    }

    // Optionally, you can clear the cart after the order is placed
    Cart::where('user_id', $user->id)->delete();

    return redirect()->back()->with('success', 'Order placed successfully');
}

public function updateOrder(Request $request, $id)
{
    $request->validate([
        'no_resi' => 'nullable|string|max:255',
        'delivery_status' => 'required|string|in:Diproses,Dikirim,Selesai,Dibatalkan',
    ]);

    $order = Order::find($id);
    if (!$order) {
        return redirect()->back()->withErrors(['error' => 'Order not found.']);
    }

    $order->no_resi = $request->no_resi;
    $order->delivery_status = $request->delivery_status;
    $order->save();

    return redirect()->back()->with('success', 'Order updated successfully.');
}

public function printOrder($id)
{
    // Ambil data order berdasarkan ID
    $order = Order::with('orderDetails')->findOrFail($id);

    // Generate PDF
    $pdf = PDF::loadView('admin.print-order', compact('order'));

    // Stream PDF ke browser
    return $pdf->stream('order-'.$id.'.pdf');
}

public function submitReview(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'order_id' => 'required|exists:orders,id',
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string|max:500'
    ]);

    $review = Review::create([
        'user_id' => Auth::id(),
        'product_id' => $request->product_id,
        'order_id' => $request->order_id,
        'rating' => $request->rating,
        'comment' => $request->comment
    ]);

    return redirect()->back()->with('success', 'Review submitted successfully!');
}




}
