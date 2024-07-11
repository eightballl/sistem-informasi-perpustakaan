<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public function register()
    {
        // Mengambil semua data pengguna dari tabel User
        $akun = User::all();

        // Menampilkan view 'admin.accounts' dengan data pengguna yang telah diambil
        return view('admin.accounts', compact('akun'));
    }

    public function actionregister(Request $request)
    {
        // Membuat pengguna baru dengan data yang diberikan dari request
        $user = User::create([
            'email' => $request->email,               // Mengambil email dari request
            'username' => $request->username,         // Mengambil username dari request
            'password' => Hash::make($request->password), // Mengambil password dari request dan mengenkripsinya
            'nama' => $request->nama,                 // Mengambil nama dari request
            'alamat' => $request->alamat,             // Mengambil alamat dari request
            'no_telp' => $request->no_telp,           // Mengambil nomor telepon dari request
            'role' => $request->role,                 // Mengambil peran (role) dari request
        ]);

        // Menyimpan pesan sukses ke dalam sesi
        Session::flash('message', 'Register Berhasil. Akun Anda sudah Aktif silahkan Login menggunakan username dan password.');

        // Mengarahkan pengguna ke halaman 'accounts'
        return redirect('accounts');
    }

    public function hapusAkun($id)
    {
        // Menghapus pengguna berdasarkan ID yang diberikan
        User::where('id', $id)->delete();

        // Mengarahkan kembali ke halaman 'accounts' dengan pesan sukses
        return redirect('/accounts')->with("sukses", "Data berhasil dihapus");
    }

    public function editAkun($id)
    {
        // Mengambil data pengguna berdasarkan ID yang diberikan
        $data = User::where('id', $id)->get();

        // Mengirimkan data pengguna sebagai JSON
        echo json_encode($data);
    }

    public function updateAkun(Request $request)
    {

        $password = $request->password;
        if (empty($password)){
            // Membuat array data baru dari request
            $data = array(
                'email' => $request->email,               // Mengambil email dari request
                'username' => $request->username,         // Mengambil username dari request
                'nama' => $request->nama,                 // Mengambil nama dari request
                'alamat' => $request->alamat,             // Mengambil alamat dari request
                'no_telp' => $request->no_telp,           // Mengambil nomor telepon dari request
                'role' => $request->role,                 // Mengambil peran (role) dari request
            );
        } else {
            $data = array(
                'email' => $request->email,               // Mengambil email dari request
                'username' => $request->username,         // Mengambil username dari request
                'password' => Hash::make($request->password), // Mengambil password dari request dan mengenkripsinya
                'nama' => $request->nama,                 // Mengambil nama dari request
                'alamat' => $request->alamat,             // Mengambil alamat dari request
                'no_telp' => $request->no_telp,           // Mengambil nomor telepon dari request
                'role' => $request->role,                 // Mengambil peran (role) dari request
            );
        }

        // Mengupdate data pengguna berdasarkan ID yang diberikan
        $simpan = User::where('id', '=', $request->post('id'))->update($data);

        // Menyimpan pesan ke dalam sesi berdasarkan hasil update
        if ($simpan) {
            Session::flash('sukses', 'Data berhasil diupdate.');
        } else {
            Session::flash('sukses', 'Data gagal diupdate.');
        }

        // Mengarahkan pengguna kembali ke halaman 'accounts'
        return redirect('/accounts');
    }
}
