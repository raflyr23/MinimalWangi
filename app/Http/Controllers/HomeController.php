<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\product;
use App\Models\cart;
use App\Models\order;
use App\Models\order_detail;
class HomeController extends Controller
{
    public function redirect(){
        $usertype=Auth::user()->usertype;
        if($usertype=="1"){

            $total_product=product::all()->count();
            $total_order=order::all()->count();
            $total_customer=user::all()->count();
            
            $order=order_detail::all();
            $total_revenue=0;

            foreach($order as $order){

                $total_revenue=$total_revenue + $order->harga;
            }

            $total_delivered=order::where('delivery_status','=','dikirim')->get()->count();
            $total_processing=order::where('delivery_status','=','diproses')->get()->count();

            return view('admin.home', compact ('total_product','total_order','total_customer', 'total_revenue', 'total_delivered','total_processing'));
    }
    else{

        $product = Product::whereNotIn('diskon', ['0%', ''])
                     ->orderByRaw('CAST(TRIM(TRAILING "%" FROM diskon) AS DECIMAL) DESC')
                     ->get();

        return view('frontend.home.home', compact('product'));
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

    public function shop(Request $request)
    {
        // Get the category from the query string
        $category = $request->get('categories_name');
        
        // If a category is selected, filter products by that category
        if ($category) {
            $product = Product::where('categories_name', $category)->paginate(9);
        } else {
            // Otherwise, get all products
            $product = Product::paginate(9);
        }
        
        // Return the view with the filtered products
        return view('frontend.shop.shop', compact('product'));
    }
    
    

public function product_search(Request $request)
{
    // Ambil kata kunci pencarian dari parameter 'search'
    $search_text = $request->search;

    // Jika kata kunci kosong, tampilkan semua produk
    if (empty($search_text)) {
        $product = Product::paginate(9);
        $message = null; // Tidak ada pesan jika pencarian kosong
    } else {
        // Cari produk yang sesuai dengan kata kunci pencarian
        $product = Product::where('nama_produk', 'LIKE', "%$search_text%")->paginate(9);

        // Jika tidak ada produk yang ditemukan
        if ($product->isEmpty()) {
            $message = "Produk yang Anda cari tidak ditemukan.";
        } else {
            $message = null; // Tidak ada pesan jika produk ditemukan
        }
    }

    // Kembalikan data ke view dengan mengirimkan variabel produk dan pesan jika ada
    return view('frontend.shop.shop', compact('product', 'message'));
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
    $product = Product::findOrFail($id);

    // Check if product is out of stock
    if ($product->jumlah <= 0) {
        return redirect()->back()->with('error', 'Maaf, produk ini sedang tidak tersedia.');
    }

    // Get quantity from input, default to 1 if not specified
    $quantity = max(1, intval($request->input('product-quantity'))); 

    // Check if requested quantity is available
    if ($quantity > $product->jumlah) {
        return redirect()->back()->with('error', 'Jumlah yang diminta melebihi stok yang tersedia.');
    }

    // Check if product already exists in cart
    $existingCart = Cart::where('user_id', $user->id)
                       ->where('product_id', $id)
                       ->first();

    if ($existingCart) {
        // Check if total quantity would exceed available stock
        if (($existingCart->jumlah + $quantity) > $product->jumlah) {
            return redirect()->back()->with('error', 'Total jumlah di keranjang akan melebihi stok yang tersedia.');
        }

        $existingCart->jumlah += $quantity;
        $existingCart->save();

        return redirect()->back()->with('success', 'Produk berhasil ditambah ke keranjang.');
    }

    // Add new item to cart
    $cart = new Cart;

    // User data
    $cart->name = $user->name;
    $cart->email = $user->email;
    $cart->no_telp = $user->no_telp ?? 'N/A';
    $cart->alamat = $user->alamat ?? 'N/A';
    $cart->user_id = $user->id;

    // Product data
    $cart->image = $product->image;
    $cart->nama_produk = $product->nama_produk;
    $cart->product_id = $product->id;

    // Calculate price with discount
    $cart->harga = $product->diskon && $product->diskon != '0%' 
        ? $product->harga - ($product->harga * intval($product->diskon) / 100)
        : $product->harga;

    $cart->jumlah = $quantity;

    $cart->save();

    return redirect()->back()->with('success', "Produk berhasil ditambah ke keranjang");
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
            return redirect()->back()->with('success', 'Barang berhasil dihapus dari keranjang anda.');
        } else {
            return redirect()->back()->with('error', 'You are not authorized to delete this item.');
        }
    } else {
        return redirect('login')->with('error', 'Please login to manage your cart.');
    }
}



}

