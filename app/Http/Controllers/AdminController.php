<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\categories;
use App\Models\product;
class AdminController extends Controller
{
    public function view_categories(){
        $data=categories::all();
        return view('admin.categories', compact('data'));

    }

    public function add_categories(Request $request){
        $data=new categories;
        $data->categories_name=$request->categories;

        $data->save();
        return redirect()->back() ->with('message','Kategori berhasil ditambahkan');


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

}