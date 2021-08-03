<?php

namespace App\Http\Controllers;

use App\Models\Buku_model;
use App\Models\PeminjamanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnggotaController extends Controller
{
    public function index()
    {
        $url = 'dashboard';
        return view('anggota.dashboard', compact('url'));
    }

    public function daftarBuku()
    {
        $url = 'daftarBuku';
        $buku = Buku_model::getBukuAnggota();
        return view('anggota.daftar-buku', compact('url', 'buku'));
    }

    public function cariBukuAnggota(Request $request)
    {
        $output = '';
        $buku = Buku_model::getBukuAnggota($request->cari);
        foreach($buku as $b) {
            $null = ($b->stok < 1) ? 'out-stok' : '';
            $output .= '
            <div class="col-md-3 ' . $null . '">
            <img src="/img/buku/'. $b->foto .'" alt="">
            <h6>'.$b->judul . '</h5>
            <p>Pengarang ' . $b->pengarang . '</p>
            </div>';
        }

        echo json_encode($output);
    }

    public function peminjamanSaya($id, $cari = null)
    {
        $peminjamanSaya = PeminjamanModel::getPeminjamanSaya($id, $cari);
        $url = 'peminjamanSaya';
        return view('anggota.peminjaman-saya', compact('url', 'peminjamanSaya'));
    }

    public function getPerpanjanganAnggotaRow(Request $request)
    {
        $peminjaman = PeminjamanModel::getPerpanjanganAnggotaRow($request->id);

        return response()->json($peminjaman);
    }

    public function perpanjangPeminjaman(Request $request)
    {
        $request->validate([
            'perpanjang_pinjam' => 'required|max:1'
        ]);

        $perpanjang_pinjam = $request->perpanjang_pinjam;
        $tgl_hrs_kembali = date('Y-m-d', strtotime('+' . $perpanjang_pinjam . ' days', strtotime($request->tgl_hrs_kembali)));

        date_default_timezone_set('Asia/Jakarta');
        DB::table('peminjaman')->where('id_peminjaman', $request->id_peminjaman)->update([
            'perpanjang_pinjam' => $perpanjang_pinjam,
            'tgl_hrs_kembali'   => $tgl_hrs_kembali,
            'updated_at'    => date('Y-m-d h:i:s')
        ]);

        return redirect('/peminjamanSaya/' . $request->id_anggota)->with('status', 'Perpanjangan pinjam buku berhasil');
    }
}
