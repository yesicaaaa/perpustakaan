<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Buku_model;
use App\Models\PetugasModel;
use App\Models\User;
use App\Models\RoleUser;
use App\Models\AnggotaModel;
use DateTime;
use Illuminate\Support\Facades\File;
use App\Exports\BukuExport;
use App\Exports\PetugasExport;
use App\Exports\AnggotaExport;
use App\Exports\PeminjamanExport;
use App\Exports\DetailPeminjamanExport;
use App\Exports\PengembalianExport;
use App\Exports\DetailPengembalianExport;
use App\Models\PeminjamanModel;
use App\Models\PengembalianModel;
use Illuminate\Container\RewindableGenerator;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;
use App;

class AdminController extends Controller
{
    public function index()
    {
        $url = 'dashboardAdmin';
        $buku = Buku_model::count('id_buku');
        $anggota = AnggotaModel::getJumlahAnggota();
        $peminjaman = PeminjamanModel::count('id_peminjaman');
        $pengembalian = PengembalianModel::count('id_pengembalian');
        $date = AdminController::convertDate(date('m-d'));
        $day = AdminController::convertDay(date('l'));
        $peminjamanGrafik = PeminjamanModel::getPeminjamanGrafikAdmin();
        $mostbook = PeminjamanModel::getPeminjamanBukuTerbanyak();
        $userGrafik = User::getTotalUser();
        $pengembalianGrafik = PengembalianModel::getPengembalianGrafik();
        return view('admin.dashboard', compact('url', 'buku', 'anggota', 'peminjaman', 'pengembalian', 'date', 'day', 'mostbook', 'peminjamanGrafik', 'userGrafik', 'pengembalianGrafik'));
    }

    public function daftarBuku(Request $request)
    {
        $url = 'daftarBuku';
        $buku = Buku_model::all();
        return view('admin.daftar-buku', compact('buku', 'url'));
    }

    public function tambahBuku(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
            'bahasa' => 'required',
            'genre' => 'required',
            'jml_halaman' => 'required',
            'stok' => 'required'
        ]);

        date_default_timezone_set('Asia/Jakarta');
        $buku = DB::table('buku')->max('id_buku');
        $id_buku = $buku + 1;
        $judul = $request->judul;
        if($request->foto != '') {
            $imageName = str_replace(" ", "_", $judul) . '.' . $request->foto->extension();
            $request->foto->move(public_path('img/buku'), $imageName);
        } else {
            $imageName = 'default.jpg';
        }
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
            'created_at'    => date('Y-m-d G:i:s'),
            'updated_at'    => null
        ]);

        return redirect('daftarBuku')->with('status', 'Berhasil menambahkan buku baru.');
    }

    public function hapusBuku(Request $request)
    {
        if($request->id == null) {
            return redirect('daftarBuku')->with('err', 'Tidak ada buku yang dipilih');
        } else {
            foreach ($request->id as $id) {
                Buku_model::where('id_buku', $id)->delete();
            }
            return redirect('daftarBuku')->with('status', 'Data buku berhasil dihapus.');
        }
    }

    public function detailBuku($id)
    {
        $url = '';
        $buku = Buku_model::where('id_buku', $id)->first();
        return view('admin.detail-buku', compact('buku', 'url'));
    }

    public function getBukuRow(Request $request)
    {
        $buku = Buku_model::where('id_buku', $request->id)->first();
        return response()->json($buku);
    }

    public function editBuku(Request $request)
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
            'foto'  => 'image|mimes:jpg, jpeg, png|max:2048'
        ]);

        $buku = Buku_model::where('id_buku', $request->id_buku)->first();

        if ($request->kurangi_stok > $buku->stok) {
            return redirect('/detailBuku/' . $buku->id_buku)->with('status', 'Pengurangan stok melebihi jumlah stok yang tersedia');
        }

        if ($request->tambah_stok != '' && $request->kurangi_stok == '') {
            $stok = $buku->stok + $request->tambah_stok;
        } else if ($request->kurangi_stok != '' && $request->tambah_stok == '') {
            $stok = $buku->stok - $request->kurangi_stok;
        } else {
            $stok = $buku->stok;
        }

        if($request->foto == '') {
            DB::table('buku')->where('id_buku', $request->id_buku)->update([
                'judul' => $request->judul,
                'pengarang' => $request->pengarang,
                'penerbit' => $request->penerbit,
                'tahun_terbit' => $request->tahun_terbit,
                'bahasa' => $request->bahasa,
                'genre' => $request->genre,
                'pengarang' => $request->pengarang,
                'jml_halaman' => $request->jml_halaman,
                'stok'  => $stok,
                'updated_at'    => Date('Y-m-d G:i:s')
            ]);
        }else{
            File::delete('img/buku/' . $buku->foto);

            $image = str_replace('', '_', $request->judul) . '.' . $request->foto->extension();
            $request->foto->move(public_path('img/buku/'), $image);

            DB::table('buku')->where('id_buku', $request->id_buku)->update([
                'judul' => $request->judul,
                'pengarang' => $request->pengarang,
                'penerbit' => $request->penerbit,
                'tahun_terbit' => $request->tahun_terbit,
                'foto'  => $image,
                'bahasa' => $request->bahasa,
                'genre' => $request->genre,
                'pengarang' => $request->pengarang,
                'jml_halaman' => $request->jml_halaman,
                'stok'  => $stok,
                'updated_at'    => Date('Y-m-d G:i:s')
            ]);
        }

        return redirect('detailBuku/' . $request->id_buku)->with('status', 'Data buku berhasil diubah.');
    }

    public function exportBukuExcel()
    {
        return Excel::download(new BukuExport, 'Daftar Buku.xlsx');
    }   

    public function exportBukuPdf()
    {
        $buku = Buku_model::all();
        $pdf = PDF::loadview('admin.export-buku', compact('buku'))->setPaper('a4');
        return $pdf->download('Daftar Buku.pdf');
        // $buku = Buku_model::all();
        // return view('admin.export-buku', compact('buku'));
    }

    public function dataPetugas(Request $request)
    {
        if($request->cari != '') {
            $cari = $request->cari;
            $request->session()->put('cari', $cari);
        }else{
            $cari = $request->session()->get('cari');
        }
        $url = 'dataPetugas';
        $petugas = PetugasModel::getPetugas($cari);
        return view('admin.data-petugas', compact('petugas', 'url'));
    }

    public function hapusPetugas(Request $request)
    {
        if($request->id == null) {
            return redirect('/dataPetugas')->with('err', 'Tidak ada data yang dipilih!');
        } else {
            foreach ($request->id as $id) {
                $image = User::where('id', $id)->first();
                if ($image->image != 'default.png') {
                    File::delete('img/user_img/' . $image->image);
                }
    
                PetugasModel::where('id', $id)->delete();
            }
            return redirect('/dataPetugas')->with('status', 'Data petugas berhasil dihapus.');
        }
    }

    public function exportPetugasExcel()
    {
        return Excel::download(new PetugasExport, 'Data Petugas.xlsx');
    }

    public function exportPetugasPdf()
    {
        $petugas = PetugasModel::select('users.*', 'roles.display_name')
                                ->join('role_user', 'role_user.user_id', '=', 'users.id')
                                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                                ->get();
        $pdf = PDF::loadview('admin.export-petugas', compact('petugas'))->setPaper('a4');
        return $pdf->download('Data Petugas.pdf');
    }


    public function detailPetugas($id)
    {
        $url = '';
        $petugas = PetugasModel::getDetailPetugas($id);
        return view('admin.detail-petugas', compact('petugas', 'url'));
    }

    public function dataAnggota(Request $request)
    {
        if($request->cari != '') {
            $cari = $request->cari;
            $request->session()->put('cari', $cari);
        }else{
            $cari = $request->session()->get('cari');
        }
        $url = 'dataAnggota';
        $anggota = AnggotaModel::getAnggota($cari);
        return view('admin.data-anggota', compact('anggota', 'url'));
    }

    public function detailAnggota($id)
    {
        $url = '';
        $anggota = AnggotaModel::getDetailAnggota($id);
        return view('admin.detail-anggota', compact('anggota', 'url'));
    }

    public function hapusAnggota(Request $request)
    {
        if($request->id == null) {
            return redirect('dataAnggota')->with('err', 'Tidak ada data yang dipilih!');
        }else{
            foreach($request->id as $id){
                $image = AnggotaModel::where('id', $id)->first();
                if($image->image != 'default.png') {
                    File::delete('img/user_img/' . $image->image);
                }
                AnggotaModel::where('id', $id)->delete();
            }
            return redirect('dataAnggota')->with('status', 'Data anggota berhasil dihapus.');
        }
    }

    public function exportAnggotaExcel()
    {
        return Excel::download(new AnggotaExport, 'Data Anggota.xlsx');
    }

    public function exportAnggotaPdf()
    {
        $anggota = AnggotaModel::select('users.*', 'roles.display_name')
                                ->join('role_user', 'role_user.user_id', '=', 'users.id')
                                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                                ->where('role_user.role_id', 3)
                                ->get();
        $pdf = PDF::loadview('admin.export-anggota', compact('anggota'))->setPaper('a4');
        return $pdf->download('Data Anggota.pdf');
    }

    public function profileSaya()
    {
        $url = '';
        return view('admin.profile-saya', compact('url'));
    }

    public function ubahProfileSaya(Request $request)
    {
        $request->validate([
            'phone' => 'required|max:13',
            'alamat'    => 'required'
        ]);

        date_default_timezone_set('Asia/Jakarta'); 
        $user = User::where('id', $request->id)->first();
        if($user->phone == $request->phone && $user->alamat == $request->alamat) {
            return redirect('/profileSayaAdmin')->with('err', 'Tidak ada perubahan apapun!');
        }else{
            DB::table('users')->where('id', $request->id)->update([
                'phone' => $request->phone,
                'alamat'    => $request->alamat,
                'updated_at'    => date('Y-m-d G:i:s')
            ]);

            return redirect('/profileSayaAdmin')->with('status', 'Data profile berhasil diubah');
        }
    }

    public function laporanPeminjaman()
    {
        $url = 'laporanPeminjaman';
        $peminjaman = PeminjamanModel::getLaporanPeminjaman();
        return view('admin.laporan-peminjaman', compact('url', 'peminjaman'));
    }

    public function exportLaporanPeminjamanExcel()
    {
        return Excel::download(new PeminjamanExport, 'Laporan Peminjaman.xlsx');
    }

    public function exportLaporanPeminjamanPdf()
    {
        $laporanPeminjaman = PeminjamanModel::getLaporanPeminjaman();
        $pdf = PDF::loadView('admin.export-laporan-peminjaman', compact('laporanPeminjaman'))->setPaper('a4');
        return $pdf->download('Laporan Peminjaman.pdf');
    }

    public function detailLaporanPeminjaman($tgl)
    {
        $url = '';
        $tanggal = $tgl;
        $detail = PeminjamanModel::getDetailLaporanPeminjaman($tgl);
        return view('admin.detail-laporan-peminjaman', compact('detail', 'url', 'tanggal'));
    }

    public function exportDetailLaporanPeminjamanExcel($tgl)
    {
        return Excel::download(new DetailPeminjamanExport($tgl), 'Detail Peminjaman ' . $tgl . '.xlsx');
    }

    public function exportDetailLaporanPeminjamanPdf($tgl)
    {
        $detailLaporan = PeminjamanModel::getDetailLaporanPeminjaman($tgl);
        $pdf = PDF::loadView('admin.export-detail-laporan-peminjaman', compact('detailLaporan'))->setPaper('a4');
        return $pdf->download('Detail Peminjaman ' . $tgl . '.pdf');
    }

    public function laporanPengembalian()
    {
        $url = 'laporanPengembalian';
        $pengembalian = PengembalianModel::getLaporanPengembalian();
        return view('admin.laporan-pengembalian', compact('url', 'pengembalian'));
    }

    public function exportLaporanPengembalianExcel()
    {
        return Excel::download(new PengembalianExport, 'Laporan Pengembalian.xlsx');
    }

    public function exportLaporanPengembalianPdf()
    {
        $laporanPengembalian = PengembalianModel::getLaporanPengembalian();
        $pdf = PDF::loadView('admin.export-laporan-pengembalian', compact('laporanPengembalian'))->setPaper('a4');
        return $pdf->download('Laporan Pengembalian.pdf');
    }

    public function detailLaporanPengembalian($tgl)
    {
        $url = '';
        $tanggal = $tgl;
        $detail = PengembalianModel::getDetailLaporanPengembalian($tgl);
        return view('admin.detail-laporan-pengembalian', compact('detail', 'url', 'tanggal'));
    }

    public function exportDetailLaporanPengembalianExcel($tgl)
    {
        return Excel::download(new DetailPengembalianExport($tgl), 'Detail Pengembalian ' . $tgl . '.xlsx');
    }

    public function exportDetailLaporanPengembalianPdf($tgl)
    {
        $detailLaporan = PengembalianModel::getDetailLaporanPengembalian($tgl);
        $pdf = PDF::loadView('admin.export-detail-laporan-pengembalian',compact('detailLaporan'))->setPaper('a4');
        return $pdf->download('Detail Pengembalian ' . $tgl . '.pdf');
    }

    private function convertDate($string)
    {
        $namaBulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $tanggal = explode('-', $string)[1];
        $bulan = explode('-', $string)[0];

        return $namaBulan[abs($bulan)] . ' ' . $tanggal;
    }

    // private function convertDay($date)
    // {
    //     setlocale(LC_ALL, 'id_ID');
    //     return strftime('%A', strtotime($date));
    // }

    private function convertDay($date)
    {
        $day = $date;

        switch($day) {
            case 'Monday':
                $hari = 'Senin';
                break;
            case 'Tuesday':
                $hari = 'Selasa';
                break;
            case 'Wednesday':
                $hari = 'Rabu';
                break;
            case 'Thursday':
                $hari = 'Kamis';
                break;
            case 'Friday':
                $hari = 'Jum\'at';
                break;
            case 'Saturday':
                $hari = 'Sabtu';
                break;
            case 'Sunday':
                $hari = 'Minggu';
                break;
        }
        return $hari;
    }
}