<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengembalianModel extends Model
{
    use HasFactory;
    protected $table = 'pengembalian';
    protected $fillable = [
        'id_pengembalian',
        'id_peminjaman',
        'tgl_kembali',
        'terlambat',
        'denda', 
        'id_petugas',
        'created_at'
    ];
}
