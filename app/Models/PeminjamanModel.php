<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Buku_model;
use App\Models\AnggotaModel;
use PhpParser\Node\Expr\Cast;

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
  //   return PeminjamanModel::join('users', 'users.id', 'peminjaman.id_anggota')
  //                           ->join('buku', 'buku.id_buku', 'peminjaman.id_buku')
  //                           ->select('users.name', 'peminjaman.*', 'buku.judul')
  //                           ->where('peminjaman.id_peminjaman', $id)
  //                           ->first();
  // }

  public static function getPinjaman($id)
  {
    return PeminjamanModel::join('buku', 'buku.id_buku', 'peminjaman.id_buku')
                          ->join('users', 'users.id', 'peminjaman.id_anggota')
                          ->select('*')
                          ->where('peminjaman.id_petugas', $id)
                          ->groupBy('users.id')
                          ->get();
  }

  public static function getPinjamanPetugas($id)
  {
    return PeminjamanModel::join('buku', 'buku.id_buku', 'peminjaman.id_buku')
                          ->join('users', 'users.id', 'peminjaman.id_anggota')
                          ->where('peminjaman.id_petugas', $id)
                          ->where('peminjaman.status', 'Dipinjam')
                          ->get();
  }

  public static function getDataAnggota($id)
  {
    return PeminjamanModel::join('users', 'users.id', 'peminjaman.id_anggota')
                            ->where('users.id', $id)
                            ->first();
  }

  public static function getDetailPeminjaman($id)
  {
    return PeminjamanModel::join('users', 'users.id', 'peminjaman.id_anggota')
                            ->join('buku', 'buku.id_buku', 'peminjaman.id_buku')
                            ->where('users.id', $id)
                            ->get();
  }

  public static function getDetailPeminjamanPetugas($id_anggota, $id_petugas)
  {
    return PeminjamanModel::join('users', 'users.id', 'peminjaman.id_anggota')
                          ->join('buku', 'buku.id_buku', 'peminjaman.id_buku')
                          ->where('peminjaman.id_anggota', $id_anggota)
                          ->where('peminjaman.id_petugas', $id_petugas)
                          ->where('peminjaman.status', 'Dipinjam')
                          ->get();
  }

  public static function getDataPeminjaman()
  {
    return PeminjamanModel::join('users', 'users.id', 'peminjaman.id_anggota')
                            ->join('buku', 'buku.id_buku', 'peminjaman.id_buku')
                            ->where('peminjaman.status', 'Dipinjam')
                            ->get();
  }

  public static function getPeminjamanRow($id)
  {
    return PeminjamanModel::join('users', 'users.id', 'peminjaman.id_anggota')
                          ->join('buku', 'buku.id_buku', 'peminjaman.id_buku')
                          ->where('peminjaman.id_peminjaman', $id)
                          ->first();
  }
  

  public static function getPeminjamanSaya($id, $cari = null)
  {
    return PeminjamanModel::join('buku', 'buku.id_buku', 'peminjaman.id_buku')
                            ->where('peminjaman.id_anggota', $id)
                            ->where('peminjaman.status', '!=', 'Dikembalikan')
                            ->where('judul', 'like', '%'.$cari.'%')
                            ->get();
  }

  public static function getPerpanjanganAnggotaRow($id)
  {
    return PeminjamanModel::join('buku', 'buku.id_buku', 'peminjaman.id_buku')
                            ->where('peminjaman.id_peminjaman', $id)
                            ->first();
  }

  public static function getHistoryPeminjaman($id, $cari = null)
  {
    return PeminjamanModel::join('buku', 'buku.id_buku', 'peminjaman.id_buku')
                            ->join('pengembalian', 'pengembalian.id_peminjaman', 'peminjaman.id_peminjaman')
                            ->join('users', 'users.id', 'pengembalian.id_petugas')
                            ->where('peminjaman.id_anggota', $id)
                            ->where('peminjaman.status', 'Dikembalikan')
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
    return PeminjamanModel::join('users', 'users.id', 'peminjaman.id_anggota')
                            ->join('buku', 'buku.id_buku', 'peminjaman.id_buku')
                            ->where('peminjaman.tgl_pinjam', $tgl)
                            ->orderBy('peminjaman.created_at', 'DESC')
                            ->get();
  }

  public static function getBukuHrsDikembalikan($id)
  {
    return PeminjamanModel::where('id_anggota', $id)
                            ->where('status', 'Dipinjam')
                            ->sum('qty');
  }

  public static function getAllPeminjamanAnggota($id)
  {
    return PeminjamanModel::join('buku', 'buku.id_buku', 'peminjaman.id_buku')
                            ->join('users', 'users.id', 'peminjaman.id_petugas')
                            ->where('peminjaman.id_anggota', $id)
                            ->get();
  }

  public static function getHarusDikembalikanAnggota($id)
  {
    return PeminjamanModel::join('buku', 'buku.id_buku', 'peminjaman.id_buku')
                            ->where('peminjaman.id_anggota', $id)
                            ->where('peminjaman.status', 'Dipinjam')
                            ->get();
  }

  public static function getPeminjamanGrafik($id)
  { 
    return PeminjamanModel::select([
                            '*',
                            DB::raw('count(id_peminjaman) as total')
                            ])
                            ->where('id_petugas', $id)
                            ->groupBy('tgl_pinjam')
                            ->orderBy('tgl_pinjam', 'DESC')
                            ->limit(7)
                            ->get();
  }

  public static function getPeminjamanGrafikAdmin()
  {
    return PeminjamanModel::select([
      '*',
      DB::raw('count(id_peminjaman) as total')
    ])
      ->groupBy('tgl_pinjam')
      ->orderBy('tgl_pinjam', 'DESC')
      ->limit(7)
      ->get();
  }

  public static function getPeminjamanBukuTerbanyak()
  {
    return PeminjamanModel::select(['peminjaman.*', 'buku.*',
                          DB::raw('count(peminjaman.id_peminjaman) as total')
                          ])
                          ->join('buku', 'buku.id_buku', 'peminjaman.id_buku')
                          ->groupBy('peminjaman.id_buku')
                          ->orderBy('peminjaman.tgl_pinjam', 'DESC')
                          ->limit(3)
                          ->get();
  }
}
