<?php

namespace App\Http\Controllers;

use App\Models\AnggotaModel;
use App\Models\Buku_model;
use App\Models\PeminjamanModel;
use App\Models\PengembalianModel;
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

        if ($request->foto != '') {
            $image = str_replace(' ', '_', $judul) . '.' . $request->foto->extension();
            $request->foto->move(public_path('img/buku'), $image);
        } else {
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
            'qty'   => 'required'
        ]);

        $peminjaman = DB::table('peminjaman')->max('id_peminjaman');
        $id_peminjaman = $peminjaman + 1;
        $tgl_pinjam = $request->tgl_pinjam;
        $tgl_hrs_kembali = date('Y-m-d', strtotime('+7 days', strtotime($tgl_pinjam)));
        $stok = Buku_model::where('id_buku', $request->id_buku)->first();
        $qty = $request->qty;
        if ($qty > $stok['stok']) {
            return redirect('dataPeminjaman')->with('err', 'Jumlah peminjaman buku melebihi stok!');
        } else {
            date_default_timezone_set('Asia/Jakarta');
            PeminjamanModel::create([
                'id_peminjaman' => $id_peminjaman,
                'id_anggota'    => $request->id_anggota,
                'id_buku'       => $request->id_buku,
                'qty'           => $request->qty,
                'tgl_pinjam'    => $tgl_pinjam,
                'tgl_hrs_kembali'   => $tgl_hrs_kembali,
                'id_petugas'    => $request->id_petugas,
                'status'        => 'Dipinjam',
                'created_at'    => date('Y-m-d h:i:s'),
                'updated_at'    => null
            ]);

            return redirect('dataPeminjaman')->with('status', 'Data peminjaman berhasil direkam');
        }
    }

    public function detailPeminjaman($id)
    {
        $peminjaman = PeminjamanModel::getDetailPeminjaman($id);
        $anggota = PeminjamanModel::getDataAnggota($id);
        return view('petugas.detail-peminjaman', compact('peminjaman', 'anggota'));
    }

    public function getPeminjamanRow(Request $request)
    {
        $peminjaman = PeminjamanModel::where('id_peminjaman', $request->id)->first();
        return response()->json($peminjaman);
    }

    public function perpanjangPinjam(Request $request)
    {
        $request->validate([
            'perpanjang_pinjam' => 'required|max:1'
        ]);

        date_default_timezone_set('Asia/Jakarta');
        $perpanjang_pinjam = $request->perpanjang_pinjam;
        $tgl_hrs_kembali = date('Y-m-d', strtotime('+' . $perpanjang_pinjam . ' days', strtotime($request->tgl_hrs_kembali)));

            DB::table('peminjaman')->where('id_peminjaman', $request->id_peminjaman)->update([
                'perpanjang_pinjam' => $perpanjang_pinjam,
                'tgl_hrs_kembali'   => $tgl_hrs_kembali,
                'updated_at'        => date('Y-m-d h:i:s')  
            ]);
            return redirect('/detailPeminjaman/' . $request->id_anggota)->with('status', 'Perpanjangan Pinjam Berhasil');
    }

    public function dataPengembalian()
    {
        $peminjaman = PeminjamanModel::getDataPeminjaman();
        return view('petugas.data-pengembalian', compact('peminjaman'));
    }

    public function getPeminjamanPengembalianRow(Request $request)
    {
        $peminjaman = PeminjamanModel::getPeminjamanRow($request->id);

        return response()->json($peminjaman);
    }

    public function pengembalian(Request $request)
    {
        $pengembalian = DB::table('pengembalian')->max('id_pengembalian');
        $id_pengembalianMax = ($pengembalian == null) ? 0 : $pengembalian;
        $id_pengembalian = $id_pengembalianMax + 1;
        $buku = Buku_model::where('id_buku', $request->id_buku)->first();

        date_default_timezone_set('Asia/Jakarta');
        PengembalianModel::create([
            'id_pengembalian'   => $id_pengembalian,
            'id_peminjaman'     => $request->id_peminjaman,
            'tgl_kembali'       => $request->tgl_kembali,
            'terlambat'         => $request->terlambat,
            'denda'             => $request->denda,
            'id_petugas'        => $request->id_petugas,
            'created_at'        => date('Y-m-d h:i:s'),
            'updated_at'        => date('Y-m-d h:i:s')
        ]);

        DB::table('buku')->where('id_buku', $request->id_buku)->update([
            'stok'  => $buku->stok + $request->qty
        ]);

        return redirect('/dataPengembalian')->with('status', 'Buku berhasil dikembalikan');
    }
}
