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

    public static function getBuku() 
    {
        return Buku_model::orderBy('judul', 'ASC')
                            ->get();
    }
}
