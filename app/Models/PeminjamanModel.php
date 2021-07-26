<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Buku_model;
use App\Models\AnggotaModel;

class PeminjamanModel extends Model
{
  use HasFactory;
  protected $table = 'peminjaman';
  protected $fillable = [
    'id_peminjaman',
    'id_anggota',
    'id_buku',
    'qty',
    'tgl_pinjam',
    'perpanjang_pinjam',
    'tgl_hrs_kembali',
    'id_petugas',
    'status',
    'created_at',
    'updated_at',
    'deleted_at'
  ];

  // public static function getDetailPinjam($id)
  // {
  //   return PeminjamanModel::join('users', 'users.id', '=', 'peminjaman.id_anggota')
  //                           ->join('buku', 'buku.id_buku', '=', 'peminjaman.id_buku')
  //                           ->select('users.name', 'peminjaman.*', 'buku.judul')
  //                           ->where('peminjaman.id_peminjaman', $id)
  //                           ->first();
  // }

  public static function getPinjaman()
  {
    return PeminjamanModel::join('buku', 'buku.id_buku', '=', 'peminjaman.id_buku')
                          ->join('users', 'users.id', '=', 'peminjaman.id_anggota')
                          ->select('*')
                          ->groupBy('users.id')
                          ->get();

  }
}
