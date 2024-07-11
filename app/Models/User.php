<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    // Menggunakan trait HasFactory untuk model ini, serta Notifiable untuk notifikasi

    protected $table = 'users';
    // Menentukan bahwa model ini terhubung dengan tabel 'users'

    protected $primaryKey = 'id';
    // Menentukan primary key dari tabel 'users' adalah 'id'

    protected $fillable = ['username', 'password', 'role', 'email', 'nama', 'alamat', 'no_telp'];
    // Mendefinisikan kolom-kolom yang dapat diisi secara massal (mass assignable)
    // Ketika menggunakan metode create() atau fill(), kolom-kolom ini yang akan diisi


}
