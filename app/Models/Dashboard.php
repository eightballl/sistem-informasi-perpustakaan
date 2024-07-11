<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dashboard extends Model
{
    protected $table = 'tb_pinjaman';
    // Menentukan nama tabel yang digunakan oleh model ini sebagai 'tb_pinjaman'

    public $timestamps = false;
    // Menonaktifkan fitur timestamps (created_at dan updated_at) pada model ini

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'id_member');
    }
    // Mendefinisikan relasi bahwa setiap pinjaman 'belongsTo' (milik) satu member,
    // dengan menggunakan model Member, dan menggunakan 'id_member' sebagai foreign key.

    public function buku(): BelongsTo
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }
    // Mendefinisikan relasi bahwa setiap pinjaman 'belongsTo' (milik) satu buku,
    // dengan menggunakan model Buku, dan menggunakan 'id_buku' sebagai foreign key.

}
