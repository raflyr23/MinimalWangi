<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Order;
use App\Models\product;
use App\Models\order_detail;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Review;
use Illuminate\Support\Facades\DB;
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

    // Check stock availability
    foreach ($cart as $item) {
        $product = Product::find($item->product_id);
        if ($product->jumlah < $item->jumlah) {
            return redirect()->back()->withErrors(['error' => "Insufficient stock for {$item->nama_produk}"]);
        }
    }
 
    $total = $cart->sum(function ($item) { 
        return $item->harga * $item->jumlah; 
    }); 
 
    DB::beginTransaction();
    try {
        // Create order
        $orders = new Order(); 
        $orders->name = $request->name;
        $orders->email = $user->email;
        $orders->no_hp = $request->no_telp;
        $orders->alamat = $request->alamat;
        $orders->user_id = $user->id; 
     
        $image = $request->file('image'); 
        $imagename = time() . '.' . $image->getClientOriginalExtension(); 
        $image->move(public_path('uploads/payments'), $imagename); 
        $orders->bukti_pembayaran = $imagename; 
     
        $orders->payment_status = 'Pending'; 
        $orders->delivery_status = ''; 
        $orders->save(); 
     
        // Add order details and update stock
        foreach ($cart as $item) { 
            $order_details = new order_detail(); 
            $order_details->order_id = $orders->id; 
            $order_details->nama_produk = $item->nama_produk; 
            $order_details->jumlah = $item->jumlah; 
            $order_details->harga = $item->harga; 
            $order_details->product_id = $item->product_id;
            $order_details->save(); 

            // Decrease product stock
            $product = Product::find($item->product_id);
            $product->jumlah -= $item->jumlah;
            $product->save();
        } 
     
        Cart::where('user_id', $user->id)->delete(); 
        
        DB::commit();
        return redirect()->back()->with('success', 'Pembayaran berhasil, pesanan akan segera diproses'); 

    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->withErrors(['error' => 'Error processing order. Please try again.']);
    }
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

public function submitReview(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'order_id' => 'required|exists:orders,id',
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string|max:500'
    ]);

    // Cek apakah pengguna sudah pernah memberikan ulasan untuk produk ini di order ini
    $existingReview = Review::where('user_id', Auth::id())
                            ->where('product_id', $request->product_id)
                            ->where('order_id', $request->order_id)
                            ->first();

    if ($existingReview) {
        return redirect()->back()->with('error', 'You have already reviewed this product.');
    }

    // Simpan review baru
    $review = Review::create([
        'user_id' => Auth::id(),
        'product_id' => $request->product_id,
        'order_id' => $request->order_id,
        'rating' => $request->rating,
        'comment' => $request->comment
    ]);

    return redirect()->back()->with('success', 'Review berhasil dikirim!');
}





}
