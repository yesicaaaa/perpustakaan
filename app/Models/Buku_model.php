<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buku_model extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'buku';
    protected $dates = ['deleted_at'];
    protected $fillable = ['id_buku', 'judul', 'pengarang', 'penerbit', 'tahun_terbit', 'foto', 'bahasa', 'genre', 'jml_halaman', 'stok', 'created_at', 'updated_at', 'deleted_at'];

    public static function getBuku($cari = null)
    {
        return Buku_model::where('judul', 'like', '%' . $cari . '%')->paginate(10);
    }

    public static function getBukuAnggota($cari = null) 
    {
        return Buku_model::where('judul', 'like', '%' . $cari . '%')
                            ->orWhere('pengarang', 'like', '%' . $cari . '%')
                            ->orderBy('judul', 'ASC')
                            ->get();
    }
}
