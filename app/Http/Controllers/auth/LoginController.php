<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login()
    {
        // Memeriksa apakah pengguna sudah login
        if (Auth::check()) {
            // Jika pengguna sudah login, arahkan mereka ke halaman dashboard
            return redirect('dashboard');
        } else {
            // Jika pengguna belum login, tampilkan halaman login
            return view('auth.login');
        }
    }


    public function actionlogin(Request $request)
    {
        // Mengambil data 'username' dan 'password' dari input request
        $data = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        // Mencoba untuk login dengan data yang diberikan
        if (Auth::attempt($data)) {
            // Jika login berhasil, arahkan ke halaman dashboard
            return redirect('dashboard');
        } else {
            // Jika login gagal, buat pesan kesalahan di sesi
            Session::flash('error', 'Email atau Password Salah');
            // Arahkan kembali ke halaman awal
            return redirect('/');
        }
    }

    public function actionlogout()
    {
        // Melakukan logout untuk pengguna yang sedang login
        Auth::logout();
        // Arahkan kembali ke halaman awal
        return redirect('/');
    }
}
