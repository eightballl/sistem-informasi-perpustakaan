<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data dari tabel Dashboard dimana kolom 'status' bernilai 1
        $dashboard = Dashboard::where('status', 1)
            // Mengurutkan hasil berdasarkan kolom 'tgl_pinjaman' secara descending
            ->orderBy('tgl_pinjaman', 'desc')
            // Mendapatkan semua hasil query dalam bentuk koleksi
            ->get();

        // Menampilkan view 'admin.dashboard' dengan data yang telah diambil
        return view('admin.dashboard', compact('dashboard'));
    }
}
