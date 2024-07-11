<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BukuController extends Controller
{
    public function index()
    {
        // Mengambil semua data buku dari tabel Buku
        $data_buku = Buku::all();

        // Menampilkan view 'admin.data_buku' dengan data buku yang telah diambil
        return view('admin.data_buku', compact('data_buku'));
    }

    public function saveBuku(Request $request)
    {
        // Menyimpan buku baru dengan data yang diberikan dari request
        $saveBuku = Buku::insert([
            'judul_buku' => $request->judul,           // Mengambil judul buku dari request
            'hal_buku' => $request->hal,               // Mengambil jumlah halaman buku dari request
            'jenis_buku' => $request->jenis,           // Mengambil jenis buku dari request
            'genre_buku' => $request->genre,           // Mengambil genre buku dari request
            'penulis' => $request->penulis,            // Mengambil penulis buku dari request
            'publisher' => $request->publisher,        // Mengambil penerbit buku dari request
            'tahun' => $request->tahun,                // Mengambil tahun terbit buku dari request
            'deskripsi' => $request->deskripsi,        // Mengambil deskripsi buku dari request
            'status' => 0,                             // Menetapkan status buku ke 0 (mungkin berarti belum dipinjam)
        ]);

        // Menyimpan pesan ke dalam sesi berdasarkan hasil simpan
        if ($saveBuku) {
            Session::flash('sukses', 'Data berhasil disimpan.');
        } else {
            Session::flash('sukses', 'Data gagal disimpan.');
        }

        // Mengarahkan pengguna ke halaman 'data-buku'
        return redirect('/data-buku');
    }

    public function hapusBuku($id)
    {
        // Menghapus buku berdasarkan ID yang diberikan
        Buku::where('id_buku', $id)->delete();

        // Mengarahkan kembali ke halaman 'data-buku' dengan pesan sukses
        return redirect('/data-buku')->with("sukses", "Data berhasil dihapus");
    }

    public function editBuku($id)
    {
        // Mengambil data buku berdasarkan ID yang diberikan
        $data = Buku::where('id_buku', $id)->get();

        // Mengirimkan data buku sebagai JSON
        echo json_encode($data);
    }

    public function updateBuku(Request $request)
    {
        // Membuat array data baru dari request
        $data = array(
            'judul_buku' => $request->judul,           // Mengambil judul buku dari request
            'hal_buku' => $request->hal,               // Mengambil jumlah halaman buku dari request
            'jenis_buku' => $request->jenis,           // Mengambil jenis buku dari request
            'genre_buku' => $request->genre,           // Mengambil genre buku dari request
            'penulis' => $request->penulis,            // Mengambil penulis buku dari request
            'publisher' => $request->publisher,        // Mengambil penerbit buku dari request
            'tahun' => $request->tahun,                // Mengambil tahun terbit buku dari request
            'deskripsi' => $request->deskripsi,        // Mengambil deskripsi buku dari request
        );

        // Mengupdate data buku berdasarkan ID yang diberikan
        $simpan = Buku::where('id_buku', '=', $request->post('id'))->update($data);

        // Menyimpan pesan ke dalam sesi berdasarkan hasil update
        if ($simpan) {
            Session::flash('sukses', 'Data berhasil diupdate.');
        } else {
            Session::flash('sukses', 'Data gagal diupdate.');
        }

        // Mengarahkan pengguna kembali ke halaman 'data-buku'
        return redirect('/data-buku');
    }
}
