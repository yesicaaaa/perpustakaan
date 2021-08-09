<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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

  public static function getDataAnggota($id)
  {
    return PeminjamanModel::join('users', 'users.id', '=', 'peminjaman.id_anggota')
                            ->where('users.id', $id)
                            ->first();
  }

  public static function getDetailPeminjaman($id)
  {
    return PeminjamanModel::join('users', 'users.id', '=', 'peminjaman.id_anggota')
                            ->join('buku', 'buku.id_buku', '=', 'peminjaman.id_buku')
                            ->select('*', 'users.name as petugas')
                            ->where('users.id', $id)
                            ->get();
  }

  public static function getDataPeminjaman()
  {
    return PeminjamanModel::join('users', 'users.id', '=', 'peminjaman.id_anggota')
                            ->join('buku', 'buku.id_buku', '=', 'peminjaman.id_buku')
                            ->where('peminjaman.status', 'Dipinjam')
                            ->get();
  }

  public static function getPeminjamanRow($id)
  {
    return PeminjamanModel::join('users', 'users.id', '=', 'peminjaman.id_anggota')
                          ->join('buku', 'buku.id_buku', '=', 'peminjaman.id_buku')
                          ->where('peminjaman.id_peminjaman', $id)
                          ->first();
  }

  public static function getPeminjamanSaya($id, $cari = null)
  {
    return PeminjamanModel::join('buku', 'buku.id_buku', '=', 'peminjaman.id_buku')
                            ->where('peminjaman.id_anggota', $id)
                            ->where('peminjaman.status', '!=', 'Dikembalikan')
                            ->where('judul', 'like', '%'.$cari.'%')
                            ->get();
  }

  public static function getPerpanjanganAnggotaRow($id)
  {
    return PeminjamanModel::join('buku', 'buku.id_buku', '=', 'peminjaman.id_buku')
                            ->where('peminjaman.id_peminjaman', $id)
                            ->first();
  }

  public static function getHistoryPeminjaman($id, $cari = null)
  {
    return PeminjamanModel::join('buku', 'buku.id_buku', '=', 'peminjaman.id_buku')
                            ->join('pengembalian', 'pengembalian.id_peminjaman', '=', 'peminjaman.id_peminjaman')
                            ->join('users', 'users.id', '=', 'pengembalian.id_petugas')
                            ->where('peminjaman.id_anggota', $id)
                            ->where('peminjaman.status', '=', 'Dikembalikan')
                            ->where('judul', 'like', '%'.$cari.'%')
                            ->get();
  }

  public static function getLaporanPeminjaman()
  {
    return PeminjamanModel::select([
                            'tgl_pinjam',
                            DB::raw('count(id_peminjaman) as buku_dipinjam')])
                            ->groupBy('tgl_pinjam')
                            ->orderBy('tgl_pinjam', 'DESC')
                            ->get();
  }

  public static function getDetailLaporanPeminjaman($tgl)
  {
    return PeminjamanModel::join('users', 'users.id', '=', 'peminjaman.id_anggota')
                            ->join('buku', 'buku.id_buku', '=', 'peminjaman.id_buku')
                            ->where('peminjaman.tgl_pinjam', $tgl)
                            ->orderBy('peminjaman.created_at', 'DESC')
                            ->get();
  }
}
