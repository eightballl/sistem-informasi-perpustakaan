<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MemberController extends Controller
{
    public function index()
    {
        // Mengambil semua data member dari tabel Member
        $member = Member::all();

        // Menampilkan view 'admin.member' dengan data member yang telah diambil
        return view('admin.member', compact('member'));
    }

    public function saveMember(Request $request)
    {
        // Menyimpan member baru dengan data yang diberikan dari request
        $saveMember = Member::insert([
            'nama' => $request->nama,                 // Mengambil nama dari request
            'alamat' => $request->alamat,             // Mengambil alamat dari request
            'no_telp' => $request->no_telp,           // Mengambil nomor telepon dari request
        ]);

        // Menyimpan pesan ke dalam sesi berdasarkan hasil simpan
        if ($saveMember) {
            Session::flash('sukses', 'Data berhasil disimpan.');
        } else {
            Session::flash('sukses', 'Data gagal disimpan.');
        }

        // Mengarahkan pengguna ke halaman 'member'
        return redirect('/member');
    }

    public function hapusMember($id)
    {
        // Menghapus member berdasarkan ID yang diberikan
        Member::where('id_member', $id)->delete();

        // Mengarahkan kembali ke halaman 'member' dengan pesan sukses
        return redirect('/member')->with("sukses", "Data berhasil dihapus");
    }

    public function editMember($id)
    {
        // Mengambil data member berdasarkan ID yang diberikan
        $data = Member::where('id_member', $id)->get();

        // Mengirimkan data member sebagai JSON
        echo json_encode($data);
    }

    public function updateMember(Request $request)
    {
        // Membuat array data baru dari request
        $data = array(
            'nama' => $request->nama,                 // Mengambil nama dari request
            'alamat' => $request->alamat,             // Mengambil alamat dari request
            'no_telp' => $request->no_telp,           // Mengambil nomor telepon dari request
        );

        // Mengupdate data member berdasarkan ID yang diberikan
        $simpan = Member::where('id_member', '=', $request->post('id_member'))->update($data);

        // Menyimpan pesan ke dalam sesi berdasarkan hasil update
        if ($simpan) {
            Session::flash('sukses', 'Data berhasil diupdate.');
        } else {
            Session::flash('sukses', 'Data gagal diupdate.');
        }

        // Mengarahkan pengguna kembali ke halaman 'member'
        return redirect('/member');
    }
}
