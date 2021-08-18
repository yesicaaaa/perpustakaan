<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

    public static function getDendaAnggota($id)
    {
        return PengembalianModel::join('peminjaman', 'peminjaman.id_peminjaman', '=', 'pengembalian.id_peminjaman')
                                ->rightJoin('users', 'users.id', '=', 'pengembalian.id_petugas')
                                ->where('peminjaman.id_anggota', $id)
                                ->where('pengembalian.denda', '!=', null)
                                ->get();
    }

    public static function getPeminjamanTerbanyak($id)
    {
        return PeminjamanModel::select([
                                'peminjaman.*',
                                'buku.*',
                                DB::raw('count(qty) as most_qty')
                                ])
                                ->join('buku', 'buku.id_buku', '=', 'peminjaman.id_buku')
                                ->where('peminjaman.id_anggota', $id)
                                ->groupBy('peminjaman.qty')
                                ->orderBy('most_qty', 'DESC')
                                ->limit(1)
                                ->first();
    }

    public static function getHistoryPengembalian($id)
    {
        return PengembalianModel::join('peminjaman', 'peminjaman.id_peminjaman', '=', 'pengembalian.id_peminjaman')
                                ->join('users', 'users.id', '=', 'peminjaman.id_anggota')
                                ->where('pengembalian.id_petugas', $id)
                                ->orderBy('tgl_kembali', 'DESC')
                                ->get();
    }

    public static function getDendaperWeek($id)
    { 
        $now = date('Y-m-d');
        return PengembalianModel::select([
                                'tgl_kembali',
                                DB::raw('sum(denda) as denda')
                                ])
                                ->where('tgl_kembali', '=', $now)
                                ->where('id_petugas', $id)
                                ->groupBy('tgl_kembali')
                                ->orderBy('created_at', 'DESC')
                                ->limit(1)
                                ->first();
    }

    public static function getPengembalianGrafik()
    {
        return PengembalianModel::select(['*', DB::raw('count(id_pengembalian) as total')])
                                ->groupBy('tgl_kembali')
                                ->orderBy('tgl_kembali', 'DESC')
                                ->limit(7)
                                ->get();
    }
}
