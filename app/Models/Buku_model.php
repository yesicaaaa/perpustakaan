<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku_model extends Model
{
    use HasFactory;
    protected $table = 'buku';
    protected $fillable = ['id_buku', 'judul', 'pengarang', 'penerbit', 'tahun_terbit', 'foto', 'bahasa', 'genre', 'jml_halaman', 'stok', 'created_at', 'updated_at', 'deleted_at'];
}
