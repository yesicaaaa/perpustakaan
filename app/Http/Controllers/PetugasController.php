<?php

namespace App\Http\Controllers;

use App\Models\AnggotaModel;
use App\Models\Buku_model;
use App\Models\PeminjamanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetugasController extends Controller
{
    public function index()
    {
        return view('petugas.dashboard');
    }

    public function daftarBuku($cari = null)
    {
        $buku = Buku_model::getBuku($cari);
        return view('petugas.daftar-buku', compact('buku'));
    }

    public function tambahBuku(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $request->validate([
            'judul' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'bahasa' => 'required',
            'genre' => 'required',
            'jml_halaman' => 'required',
            'foto' => 'image|mimes:jpeg,jpg,png|max:2048',
            'stok' => 'required'
        ]);

        $buku = DB::table('buku')->max('id_buku');
        $id_buku = $buku + 1;
        $judul = $request->judul;

        if($request->foto != '') {
            $image = str_replace(' ', '_', $judul) . '.' . $request->foto->extension();
            $request->foto->move(public_path('img/buku'), $image);
        }else{
            $image = 'default.jpg';
        }

        Buku_model::create([
            'id_buku'   => $id_buku,
            'judul' => $judul,
            'pengarang' => $request->pengarang,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'bahasa' => $request->bahasa,
            'genre' => $request->genre,
            'jml_halaman' => $request->jml_halaman,
            'foto' => $image,
            'stok' => $request->stok,
            'created_at'    => date('Y-m-d h:i:s'),
            'updated_at'    => null
        ]);

        return redirect('daftarBukuPetugas')->with('status', 'Buku baru berhasil ditambahkan');
    }

    public function dataAnggota($cari = null)
    {
        $anggota = AnggotaModel::getAnggota($cari);
        return view('petugas.data-anggota', compact('anggota'));
    }

    public function dataPeminjaman($id = null)
    {
        $anggota = AnggotaModel::getListAnggota();
        $buku = Buku_model::all();
        // $detailPinjaman = PeminjamanModel::getDetailPinjam($id);
        $peminjaman = PeminjamanModel::getPinjaman();
        return view('petugas.data-peminjaman', compact('anggota', 'buku', 'peminjaman'));
    }

    public function tambahPeminjaman(Request $request)
    {
        $request->validate([
            'id_anggota'  => 'required',
            'id_buku'   => 'required',
            'tgl_pinjam'    => 'required',
            'tgl_hrs_kembali'   => 'required',
            'qty'   => 'required'
        ]);

        date_default_timezone_set('Asia/Jakarta');
        $peminjaman = DB::table('peminjaman')->max('id_peminjaman');
        $id_peminjaman = $peminjaman + 1;
        PeminjamanModel::create([
                'id_peminjaman' => $id_peminjaman,
                'id_anggota'    => $request->id_anggota,
                'id_buku'       => $request->id_buku,
                'qty'           => $request->qty,
                'tgl_pinjam'    => $request->tgl_pinjam,
                'tgl_hrs_kembali'   => $request->tgl_hrs_kembali,
                'id_petugas'    => $request->id_petugas,
                'status'        => 'Dikonfirmasi',
                'created_at'    => date('Y-m-d h:i:s')
        ]);
    }
}
