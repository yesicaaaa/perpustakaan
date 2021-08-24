<?php

namespace App\Http\Controllers;

use App\Exports\AnggotaDitambahkanExport;
use App\Exports\bukuDitambahkanExport;
use App\Exports\DetailPeminjamanPetugasExport;
use App\Exports\PeminjamanPetugasExport;
use App\Exports\DataPengembalianPetugasExport;
use App\Exports\HistoryPengembalianPetugasExport;
use App\Models\AnggotaModel;
use App\Models\Buku_model;
use App\Models\PeminjamanModel;
use App\Models\PengembalianModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade AS PDF;

class PetugasController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $url = 'dashboardPetugas';
        $buku = Buku_model::select([ DB::raw('count(id_buku) as total')])
                            ->where('created_by', $id)
                            ->first();
        $anggota = AnggotaModel::getJumlahAnggotaPetugas($id);
        $peminjaman = PeminjamanModel::where('id_petugas', $id)->count('id_peminjaman');
        $pengembalian = PengembalianModel::where('id_petugas', $id)->count('id_pengembalian');
        $reportWeek = PengembalianModel::getDendaperWeek($id);
        $peminjamanGrafik = PeminjamanModel::getPeminjamanGrafik($id);
        return view('petugas.dashboard', compact('url', 'buku', 'anggota', 'peminjaman', 'pengembalian', 'reportWeek', 'peminjamanGrafik'));
    }

    public function bukuDitambahkanPetugas()
    {
        $url = 'dashboardPetugas';
        $id = Auth::user()->id;
        $buku = Buku_model::where('created_by', $id)->get();
        return view('petugas.buku-ditambahkan-petugas', compact('buku', 'url'));
    }

    public function exportBukuDitambahkanExcel()
    {
        $id = Auth::user()->id;
        $petugas = Buku_model::join('users', 'users.id', 'buku.created_by')->where('buku.created_by', $id)->first();
        return Excel::download(new bukuDitambahkanExport, 'Buku Ditambahkan Petugas[' . $petugas['name'] . '].xlsx');
    }

    public function exportBukuDitambahkanPdf()
    {
        $id = Auth::user()->id;
        $buku = Buku_model::where('created_by', $id)->get();
        $petugas = Buku_model::join('users', 'users.id', 'buku.created_by')->where('buku.created_by', $id)->first();
        $pdf = PDF::loadView('petugas.export-buku-ditambahkan-petugas', compact('buku'))->setPaper('a4');
        return $pdf->download('Buku Ditambahkan Petugas[' . $petugas['name'] . '].pdf');
    }

    public function anggotaDitambahkanPetugas()
    {
        $url = 'dashboardPetugas';
        $id = Auth::user()->id;
        $anggota = AnggotaModel::getAnggotaPetugas($id);
        return view('petugas.anggota-ditambahkan-petugas', compact('anggota', 'url'));
    }

    public function exportAnggotaDitambahkanExcel()
    {
        $id = Auth::user()->id;
        $petugas = Buku_model::join('users', 'users.id', 'buku.created_by')->where('buku.created_by', $id)->first();
        return Excel::download(new AnggotaDitambahkanExport($id), 'Anggota Ditambahkan Petugas[' . $petugas['name'] . '].xlsx');
    }

    public function exportAnggotaDitambahkanPdf()
    {
        $id = Auth::user()->id;
        $anggota = AnggotaModel::getAnggotaPetugas($id);
        $pdf = PDF::loadView('petugas.export-anggota-ditambahkan-petugas', compact('anggota'))->setPaper('a4');
        $petugas = Buku_model::join('users', 'users.id', 'buku.created_by')->where('buku.created_by', $id)->first();
        return $pdf->download('Anggota Ditambahkan Petugas[' . $petugas['name'] . '].pdf');
    }

    public function daftarBuku()
    {
        $url = 'daftarBukuPetugas';
        $buku = Buku_model::all();
        return view('petugas.daftar-buku', compact('buku', 'url'));
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
            'foto'  => 'required|image|mimes: jpeg, jpg, png|max:2048',
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
            'created_at'    => date('Y-m-d G:i:s'),
            'updated_at'    => null
        ]);

        return redirect('daftarBukuPetugas')->with('status', 'Buku baru berhasil ditambahkan');
    }

    public function dataAnggota()
    {
        $url = 'dataAnggotaPetugas';
        $anggota = AnggotaModel::getAnggota();
        return view('petugas.data-anggota', compact('anggota', 'url'));
    }

    public function dataPeminjaman()
    {
        $id = Auth::user()->id;
        $url = 'dataPeminjaman';
        $anggota = AnggotaModel::getListAnggota();
        $buku = Buku_model::where('stok' , '>', 0)->get();
        $peminjaman = PeminjamanModel::getPinjaman($id);
        return view('petugas.data-peminjaman', compact('anggota', 'buku', 'peminjaman', 'url'));
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
                'created_at'    => date('Y-m-d G:i:s'),
                'updated_at'    => null
            ]);

            return redirect('dataPeminjaman')->with('status', 'Data peminjaman berhasil direkam');
        }
    }

    public function exportPeminjamanPetugasExcel()
    {
        $id = Auth::user()->id;
        $petugas = User::where('id', $id)->first();
        return Excel::download(new PeminjamanPetugasExport($id), 'Data Peminjaman Petugas[' . $petugas['name'] . '].xlsx');
    }

    public function exportPeminjamanPetugasPdf()
    {
        $id = Auth::user()->id;
        $peminjaman = PeminjamanModel::getPinjamanPetugas($id);
        $petugas = User::where('id', $id)->first();
        $pdf = PDF::loadView('petugas.export-peminjaman-petugas', compact('peminjaman'))->setPaper('a4');
        return $pdf->download('Data Peminjaman Petugas[' . $petugas['name'] . '].pdf');
    }

    public function detailPeminjaman($id)
    {
        $url = '';
        $peminjaman = PeminjamanModel::getDetailPeminjaman($id);
        $anggota = PeminjamanModel::getDataAnggota($id);
        $jml_dipinjam = PeminjamanModel::select([DB::raw('count(id_peminjaman) as jml')])
                                        ->where('id_anggota', $id)
                                        ->where('status', 'Dipinjam')
                                        ->first();
        return view('petugas.detail-peminjaman', compact('peminjaman', 'anggota', 'url', 'jml_dipinjam'));
    }

    public function exportDetailPeminjamanPetugasExcel($id_anggota)
    {
        $id = Auth::user()->id;
        $anggota = PeminjamanModel::join('users', 'users.id', 'peminjaman.id_anggota')->first();
        $petugas = Buku_model::join('users', 'users.id', 'buku.created_by')->where('buku.created_by', $id)->first();
        return Excel::download(new DetailPeminjamanPetugasExport($id_anggota, $id), 'Peminjaman AGT[' . $anggota['name'] . '] Petugas[' . $petugas['name'] . '].xlsx');
    }

    public function exportDetailPeminjamanPetugasPdf($id_anggota)
    {
        $id = Auth::user()->id;
        $anggota = PeminjamanModel::join('users', 'users.id', 'peminjaman.id_anggota')->first();
        $peminjaman = PeminjamanModel::getDetailPeminjamanPetugas($id_anggota, $id);
        $petugas = Buku_model::join('users', 'users.id', 'buku.created_by')->where('buku.created_by', $id)->first();
        $pdf = PDF::loadView('petugas.export-detail-peminjaman-petugas', compact('peminjaman'))->setPaper('a4');
        return $pdf->download('Peminjaman AGT[' . $anggota['name'] . '] Petugas[' . $petugas['name'] . '].pdf');
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
        $hrs_kembali = strtotime($request->tgl_hrs_kembali);
        $now = strtotime(date('Y-m-d'));

        if ($hrs_kembali <= $now) {
            return redirect('/detailPeminjaman/' . $request->id_anggota)->with('err', 'Buku sudah harus dikembalikan!');
        } else {
            DB::table('peminjaman')->where('id_peminjaman', $request->id_peminjaman)->update([
                'perpanjang_pinjam' => $perpanjang_pinjam,
                'tgl_hrs_kembali'   => $tgl_hrs_kembali,
                'updated_at'        => date('Y-m-d h:i:s')
            ]);
            return redirect('/detailPeminjaman/' . $request->id_anggota)->with('status', 'Perpanjangan Pinjam Berhasil');
        }
    }

    public function dataPengembalian()
    {
        $url = 'dataPengembalian';
        $peminjaman = PeminjamanModel::getDataPeminjaman();
        return view('petugas.data-pengembalian', compact('peminjaman', 'url'));
    }

    public function exportDataPengembalianPetugasExcel()
    {
        return Excel::download(new DataPengembalianPetugasExport, 'Daftar Buku Harus Dikembalikan.xlsx');
    }

    public function exportDataPengembalianPetugasPdf()
    {
        $pengembalian = PeminjamanModel::getDataPeminjaman();
        $pdf = PDF::loadView('petugas.export-data-pengembalian-petugas', compact('pengembalian'))->setPaper('a4');
        return $pdf->download('Daftar Buku Harus Dikembalikan.pdf');
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
            'created_at'        => date('Y-m-d G:i:s'),
            'updated_at'        => date('Y-m-d G:i:s')
        ]);

        DB::table('buku')->where('id_buku', $request->id_buku)->update([
            'stok'  => $buku['stok'] + $request->qty
        ]);

        return redirect('/dataPengembalian')->with('status', 'Buku berhasil dikembalikan');
    }

    public function profileSaya()
    {
        $url = '';
        return view('petugas.profile-saya', compact('url'));
    }

    public function ubahProfileSaya(Request $request)
    {
        $request->validate([
            'phone' => 'required|max:13',
            'alamat'    => 'required'
        ]);

        date_default_timezone_set('Asia/Jakarta');
        $user = User::where('id', $request->id)->first();
        if ($user->phone == $request->phone && $user->alamat == $request->alamat) {
            return redirect('/profileSayaPetugas')->with('err', 'Tidak ada perubahan apapun!');
        } else {
            DB::table('users')->where('id', $request->id)->update([
                'phone' => $request->phone,
                'alamat'    => $request->alamat,
                'updated_at'    => date('Y-m-d G:i:s')
            ]);

            return redirect('profileSayaPetugas')->with('status', 'Data profile berhasil diubah!');
        }
    }

    public function historyPengembalian()
    {
        $id = Auth::user()->id;
        $url = 'historyPengembalian';
        $historyPengembalian = PengembalianModel::getHistoryPengembalian($id);
        return view('petugas.history-pengembalian', compact('url', 'historyPengembalian'));
    }

    public function exportHistoryPengembalianPetugasExcel()
    {
        $id = Auth::user()->id;
        $petugas = PengembalianModel::join('users', 'users.id', 'pengembalian.id_petugas')->where('pengembalian.id_petugas', $id)->first();
        return Excel::download(new HistoryPengembalianPetugasExport($id), 'History Pengembalian Petugas[' . $petugas['name'] . '].xlsx');
    }

    public function exportHistoryPengembalianPetugasPdf()
    {
        $id = Auth::user()->id;
        $petugas = PengembalianModel::join('users', 'users.id', 'pengembalian.id_petugas')->where('pengembalian.id_petugas', $id)->first();
        $pengembalian = PengembalianModel::getHistoryPengembalian($id);
        $pdf = PDF::loadView('petugas.export-history-pengembalian-petugas', compact('pengembalian'))->setPaper('a4');
        return $pdf->download('History Pengembalian Petugas[' . $petugas['name'] . '].pdf');
    }
}
