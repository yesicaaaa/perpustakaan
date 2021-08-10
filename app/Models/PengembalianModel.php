<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public static function getLaporanPengembalian()
    {
        return PengembalianModel::select(['tgl_kembali',
                                DB::raw('count(id_pengembalian) as buku_dikembalikan')])
                                ->groupBy('tgl_kembali')
                                ->orderBy('tgl_kembali', 'DESC')
                                ->get();

    }

    public static function getDetailLaporanPengembalian($tgl)
    {
        return PengembalianModel::join('peminjaman', 'peminjaman.id_peminjaman', '=', 'pengembalian.id_peminjaman')
                                ->join('users', 'users.id', '=', 'peminjaman.id_anggota')
                                ->join('buku', 'buku.id_buku', '=', 'peminjaman.id_buku')
                                ->where('pengembalian.tgl_kembali', $tgl)
                                ->orderBy('pengembalian.created_at', 'DESC')
                                ->get();
    }

    public static function getJumlahBukuPengembalian($id)
    {
        return PengembalianModel::select([
                                DB::raw('sum(peminjaman.qty) as jml_buku')
                                ])
                                ->join('peminjaman', 'peminjaman.id_peminjaman', '=', 'pengembalian.id_peminjaman')
                                ->where('peminjaman.id_anggota', $id)
                                ->first();
    }

    public static function getTotalDenda($id)
    {
        return PengembalianModel::select([DB::raw('sum(pengembalian.denda) as denda')])
                                ->join('peminjaman', 'peminjaman.id_peminjaman', '=', 'pengembalian.id_peminjaman')
                                ->where('peminjaman.id_anggota', $id)
                                ->first();
    }
}
