<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Member;
use App\Models\Pinjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PinjamanController extends Controller
{
    public function index()
    {
        // Mengambil semua data pinjaman dengan status 1
        $data_pinjaman = Pinjaman::where('status', 1)->get();

        // Mengambil semua data member
        $member = Member::all();

        // Mengambil semua data buku dengan status 0
        $buku = Buku::where('status', 0)->get();

        // Menampilkan view 'admin.data_pinjaman' dengan data pinjaman, member, dan buku
        return view('admin.data_pinjaman', compact('data_pinjaman', 'member', 'buku'));
    }

    public function riwayat()
    {
        // Mengambil semua data riwayat pinjaman dengan status 2
        $riwayat_pinjaman = Pinjaman::where('status', 2)->get();

        // Menampilkan view 'admin.riwayat_pinjaman' dengan data riwayat pinjaman
        return view('admin.riwayat_pinjaman', compact('riwayat_pinjaman'));
    }

    public function savePinjaman(Request $request)
    {
        // Mengambil tanggal dan waktu saat ini untuk tgl_pinjaman
        $tgl_pinjaman = date("Y-m-d H:i:s");

        // Menyimpan pinjaman baru dengan data dari request
        $savePinjaman = Pinjaman::insert([
            'id_member' => $request->nama,            // Mengambil id_member dari request
            'id_buku' => $request->judul,             // Mengambil id_buku dari request
            'tgl_pinjaman' => $tgl_pinjaman,          // Mengisi tgl_pinjaman dengan tanggal dan waktu saat ini
            'lama_pinjaman' => $request->lama,        // Mengambil lama pinjaman dari request
            'id_admin' => Auth::user()->id,           // Mengambil id_admin dari pengguna yang sedang login
            'status' => 1,                            // Menetapkan status pinjaman ke 1 (mungkin berarti sedang dipinjam)
        ]);

        // Mengupdate status buku menjadi 1 (mungkin berarti sedang dipinjam)
        $updateStatus = Buku::where('id_buku', '=', $request->post('judul'))->update([
            'status' => 1
        ]);

        // Menyimpan pesan ke dalam sesi berdasarkan hasil simpan
        if ($savePinjaman && $updateStatus) {
            Session::flash('sukses', 'Data berhasil disimpan.');
        } else {
            Session::flash('sukses', 'Data gagal disimpan.');
        }

        // Mengarahkan pengguna ke halaman 'data-pinjaman'
        return redirect('/data-pinjaman');
    }

    public function editKembali($id)
    {
        // Mengambil data pinjaman berdasarkan ID yang diberikan
        $data = Pinjaman::where('id_pinjaman', $id)->get();

        // Mengirimkan data pinjaman sebagai JSON
        echo json_encode($data);
    }

    public function updateKembali(Request $request)
    {
        // Mengambil tanggal dan waktu saat ini untuk tgl_kembali
        $tgl_kembali = date("Y-m-d H:i:s");

        // Membuat array data baru dari request
        $data = array(
            'tgl_kembali' => $tgl_kembali,            // Mengisi tgl_kembali dengan tanggal dan waktu saat ini
            'status' => 2,                            // Menetapkan status pinjaman ke 2 (mungkin berarti sudah dikembalikan)
        );

        // Mengupdate data pinjaman berdasarkan ID yang diberikan
        $update = Pinjaman::where('id_pinjaman', '=', $request->post('id_pinjaman'))->update($data);

        // Mengupdate status buku menjadi 0 (mungkin berarti tersedia untuk dipinjam)
        $updateStatus = Buku::where('id_buku', '=', $request->post('id_buku'))->update([
            'status' => 0
        ]);

        // Menyimpan pesan ke dalam sesi berdasarkan hasil update
        if ($update && $updateStatus) {
            Session::flash('sukses', 'Data berhasil diupdate.');
        } else {
            Session::flash('sukses', 'Data gagal diupdate.');
        }

        // Mengarahkan pengguna kembali ke halaman 'data-pinjaman'
        return redirect('/data-pinjaman');
    }
}
