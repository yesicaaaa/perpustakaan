<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Buku_model;
use DateTime;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function daftarBuku()
    {
        $buku = Buku_model::all();
        return view('admin.daftar-buku', compact('buku'));
    }

    public function tambahBuku(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'bahasa' => 'required',
            'genre' => 'required',
            'jml_halaman' => 'required',
            'stok' => 'required'
        ]);

        date_default_timezone_set('Asia/Jakarta');
        $buku = DB::table('buku')->max('id_buku');
        $id_buku = $buku + 1;
        $judul = $request->judul;
        $imageName = str_replace(" ", "_", $judul) . '.' . $request->foto->extension();
        $request->foto->move(public_path('img/buku'), $imageName);
        Buku_model::create([
            'id_buku'   => $id_buku,
            'judul' => $judul,
            'pengarang' => $request->pengarang,
            'penerbit'  => $request->penerbit,
            'tahun_terbit'  => $request->tahun_terbit,
            'foto'  => $imageName,
            'bahasa'    => $request->bahasa,
            'genre' => $request->genre,
            'jml_halaman'   => $request->jml_halaman,
            'stok'  => $request->stok,
            'created_at'    => date('Y-m-d h:i:s')
        ]);

        return redirect('daftarBuku')->with('status', 'Berhasil menambahkan buku baru.');
    }

    public function hapusBuku(Request $request)
    {
        foreach($request->id as $id)
        {
            $image = Buku_model::where('id_buku', $id)->first();
            File::delete('img/buku/' . $image->foto);

            Buku_model::where('id_buku', $id)->delete();
        }
        return redirect('daftarBuku')->with('status', 'Data buku berhasil dihapus.');
    }

    public function detailBuku($id)
    {
        $buku = Buku_model::where('id_buku', $id)->first();
        return view('admin.detail-buku', compact('buku'));
    }

    public function getBukuRow(Request $request)
    {
        $buku = Buku_model::where('id_buku', $request->id)->first();
        return response()->json($buku);
    }
}
