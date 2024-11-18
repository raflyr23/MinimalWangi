<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\product;
use App\Models\cart;
use App\Models\order;
class HomeController extends Controller
{
    public function redirect(){
        $usertype=Auth::user()->usertype;
        if($usertype=="1"){
            return view('admin.home');
    }
    else{
        return view('frontend.home.home');
    }
}

    public function index()
    {
   //view untuk mengatur tampilan awal
   $product=product::all();
        return view('frontend.home.home', compact('product'));
    }

    public function about()
    {
       //untuk beralih ke tampilan about
        return view('frontend.about.about');
    }

    public function shop()
    {
        $product=product::all();
       //untuk beralih ke tampilan shop
        return view('frontend.shop.shop', compact('product'));
    }

    public function contact()
    {
       //untuk beralih ke tampilan contact
        return view('frontend.contact.contact');
    }

    public function detail()
    {
       //untuk beralih ke tampilan contact
        return view('frontend.detail-shop.main');
    }

    public function product_details($id)
{
    $product = product::find($id);

    if (!$product) {
        return redirect('/shop')->with('error', 'Produk tidak ditemukan!');
    }

    return view('frontend.home.product_details', compact('product'));
}

public function add_cart(Request $request, $id)
{
    if (!Auth::check()) {
        return redirect('login')->with('error', 'Please login to add products to cart.');
    }

    $user = Auth::user();
    $product = Product::findOrFail($id); // Gunakan `findOrFail` agar error handling lebih baik
    $cart = new Cart;

    // Data pengguna
    $cart->name = $user->name;
    $cart->email = $user->email;
    $cart->no_telp = $user->no_telp ?? 'N/A'; // Default jika no_telp kosong
    $cart->alamat = $user->alamat ?? 'N/A';   // Default jika alamat kosong
    $cart->user_id = $user->id;

    // Data produk
    $cart->image = $product->image;
    $cart->nama_produk = $product->nama_produk;

    // Hitung harga berdasarkan diskon
    if ($product->diskon && $product->diskon != '0%') {
        $cart->harga = $product->harga - ($product->harga * intval($product->diskon) / 100);
    } else {
        $cart->harga = $product->harga;
    }

    $cart->product_id = $product->id;

    // Set jumlah default ke 1
    $cart->jumlah = 1;

    $cart->save();

    return redirect()->back()->with('success', 'Product added to cart with quantity of 1.');
}


public function show_cart()
{
    if (Auth::id()) {
        $id = Auth::user()->id;
        $cart = cart::where('user_id', '=', $id)->get();
        $total = $cart->sum(function ($item) {
            return $item->harga * $item->jumlah;
        });

        return view('frontend.cart.cart', compact('cart', 'total'));
    } else {
        return redirect('login');
    }
}


public function remove_cart($id)
{
    if (Auth::check()) {
        $cartItem = Cart::findOrFail($id); // Cari item cart berdasarkan ID
        if ($cartItem->user_id == Auth::id()) { // Pastikan hanya pemilik keranjang yang bisa menghapus
            $cartItem->delete();
            return redirect()->back()->with('success', 'Item successfully removed from cart.');
        } else {
            return redirect()->back()->with('error', 'You are not authorized to delete this item.');
        }
    } else {
        return redirect('login')->with('error', 'Please login to manage your cart.');
    }
}



}

