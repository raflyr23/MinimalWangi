<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\categories;
use App\Models\product;
use App\Models\order;
use App\Models\order_detail;
class AdminController extends Controller
{
    public function view_categories(){
        $data=categories::all();
        return view('admin.categories', compact('data'));

    }

    public function add_categories(Request $request) {
        $request->validate([
            'categories' => 'required|string|max:255',
        ], [
            'categories.required' => 'Nama kategori wajib diisi.',
            'categories.string' => 'Nama kategori harus berupa teks.',
            'categories.max' => 'Nama kategori tidak boleh lebih dari 255 karakter.',
        ]);

        $data = new Categories;
        $data->categories_name = $request->categories;
        $data->save();

        return redirect()->back()->with('message', 'Kategori berhasil ditambahkan');
    }


    public function delete_categories($id){
        $data=categories::find($id);
        $data ->delete();
        return redirect()->back()->with('message','Kategori berhasil dihapus');
}

public function view_product(){
    $categories= categories::all();
    return view('admin.product', compact('categories'));
}

public function add_product(Request $request){
    $product = new Product;

    $product->nama_produk = $request->title;
    $product->deskripsi = $request->description;
    $product->harga = $request->harga;
    $product->diskon = $request->diskon;
    $product->jumlah = $request->jumlah;
    $product->categories_name = $request->categories;

    // Proses upload gambar
    $image = $request->file('image');
    $imagename = time() . '.' . $image->getClientOriginalExtension();
    $image->move('product', $imagename);

    // Tetapkan nilai gambar sebelum menyimpan
    $product->image = $imagename;

    // Simpan data produk
    $product->save();

    return redirect()->back()->with('message', 'Produk berhasil ditambahkan!');


}
public function show_product(){
    $product = Product::all();
    return view('admin.show_product', compact('product'));
}

public function delete_product($id){
    $product = Product::find($id);
    $product->delete();
    return redirect()->back()->with('message', 'Produk berhasil dihapus');
}

public function update_product($id){
    $product = Product::find($id);
    $categories=categories::all();
    return view('admin.update_product', compact('product', 'categories'));
}

public function update_product_confirm(Request $request, $id){
    $product = Product::find($id);

    $product->nama_produk = $request->title;
    $product->deskripsi = $request->description;
    $product->harga = $request->harga;
    $product->diskon = $request->diskon;
    $product->jumlah = $request->jumlah;
    $product->categories_name = $request->categories;
    $image=$request->image;
    if($image){
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product', $imagename);
        $product->image=$imagename;
    }

    $product->save();
    return redirect()->back()->with('message', 'Produk berhasil diupdate');
}

public function order(){
    $orders = Order::with('orderDetails')->get();

    return view('admin.order', compact('orders'));
}

public function updateOrderStatus(Request $request, $id)
{
    // Mencari order berdasarkan ID
    $order = Order::find($id);

    if ($order) {
        // Update status pembayaran dan pengiriman
        $order->payment_status = $request->payment_status;
        $order->delivery_status = $request->delivery_status;
        $order->no_resi = $request->no_resi;
        $order->save();

        // Log untuk memeriksa status yang diterima
        \Log::info("Order ID {$id} updated. Payment Status: {$order->payment_status}, Delivery Status: {$order->delivery_status}");

        // Jika status adalah "Failed" atau "Dibatalkan", update stok produk
        if ($request->payment_status == 'Failed' || $request->delivery_status == 'Dibatalkan') {
            $orderDetails = order_detail::where('order_id', $id)->get();

            // Jika order details ditemukan
            if ($orderDetails->isEmpty()) {
                \Log::warning("No order details found for Order ID {$id}");
            }

            // Mengembalikan stok produk
            foreach ($orderDetails as $detail) {
                $product = Product::find($detail->product_id);
                if ($product) {
                    $product->jumlah += $detail->jumlah;  // Menambah stok produk
                    $product->save();
                    \Log::info("Updated product ID {$product->id}. New stock: {$product->jumlah}");
                } else {
                    \Log::warning("Product ID {$detail->product_id} not found for Order ID {$id}");
                }
            }

            // Log untuk menandai bahwa stok sudah diperbarui
            \Log::info("Stock updated for Order ID {$id}");
        }

        // Mengembalikan feedback sukses
        return redirect()->back()->with('success', 'Order status updated successfully!');
    }

    // Jika order tidak ditemukan
    return redirect()->back()->with('error', 'Order not found!');
}



public function searchdata(request $request){

    $searchText=$request->search;
    $order=order::where('name','LIKE',"%$searchText%")->orwhere ('payment_status','LIKE',"%$searchText%")->get();

    return view('admin.order', compact('order'));
}





}
