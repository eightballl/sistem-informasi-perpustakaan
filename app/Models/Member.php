<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    // Menggunakan trait HasFactory untuk model ini

    protected $table = 'tb_member';
    // Menentukan bahwa model ini terhubung dengan tabel 'tb_member'

    protected $primaryKey = 'id_member';
    // Menentukan primary key dari tabel 'tb_member' adalah 'id_member'

    public $timestamps = false;
    // Menonaktifkan fitur timestamps (created_at dan updated_at) pada model ini

}
