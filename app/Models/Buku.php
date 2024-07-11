<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    // Menggunakan trait HasFactory untuk model ini

    protected $table = 'tb_buku';
    // Mendefinisikan nama tabel yang digunakan oleh model ini sebagai 'tb_buku'

    protected $primaryKey = 'id_buku';
    // Mendefinisikan primary key dari tabel 'tb_buku' sebagai 'id_buku'

    public $timestamps = false;
    // Menonaktifkan fitur timestamps (created_at dan updated_at) pada model ini

}
