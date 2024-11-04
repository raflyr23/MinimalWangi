<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function index()
    {
        return view('login.login');
    }

    public function save(Request $request)
    {
        $data_user = User::create([
            "name"=>$request->input("nama"),
            "email"=>$request->input("email"),
            'password' => Hash::make($request->input("password")),
            "account_status"=>2,
        ]);

        if($data_siswa and $data_user){
            Session::flash('sukses','Data Berhasil Ditambahkan');
            return redirect('/data-siswa')
                ->with("data_user",$data_user)
                ->with("data_siswa",$data_siswa);
        }else{
            Session::flash('gagal','Gagal Menambahkan Data');
            return redirect('/data-siswa');
        }
    }

    public function updateProfile(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->nama = $request->nama;
        $user->no_telp = $request->no_telp;
        $user->email = $request->email;
        $user->save();

        return response()->json(['message' => 'Profile updated successfully']);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Cek kredensial login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Regenerasi sesi setelah login untuk keamanan
            $request->session()->regenerate();

            return redirect()->intended('/dashboard'); // Ganti '/dashboard' dengan rute tujuan setelah login
        }

        // Jika gagal, kembalikan pesan kesalahan
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

}
