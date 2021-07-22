<?php

namespace App\Http\Controllers;

use App\Models\AnggotaModel;
use App\Models\Buku_model;
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
}
