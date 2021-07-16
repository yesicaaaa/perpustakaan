<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Buku_model;
use App\Models\PetugasModel;
use App\Models\User;
use App\Models\RoleUser;
use DateTime;
use Illuminate\Support\Facades\File;
use App\Exports\BukuExport;
use App\Exports\PetugasExport;
use Illuminate\Container\RewindableGenerator;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function daftarBuku(Request $request)
    {
        if($request->cari != '') {
            $cari = $request->cari;
            $request->session()->put('cari', $request->cari);
        }else{
            $cari = $request->session()->get('cari');
        }
        $buku = Buku_model::getBuku($cari);
        return view('admin.daftar-buku', compact('buku'));
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
            'created_at'    => date('Y-m-d h:i:s'),
            'updated_at'    => null
        ]);

        return redirect('daftarBuku')->with('status', 'Berhasil menambahkan buku baru.');
    }

    public function hapusBuku(Request $request)
    {
        foreach ($request->id as $id) {
            $image = Buku_model::where('id_buku', $id)->first();
            if($image->foto != 'default.jpg') {
                File::delete('img/buku/' . $image->foto);
            }

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
                'updated_at'    => Date('Y-m-d h:i:s')
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
                'updated_at'    => Date('Y-m-d h:i:s')
            ]);
        }

        return redirect('detailBuku/' . $request->id_buku)->with('status', 'Data buku berhasil diubah.');
    }

    public function exportBukuExcel()
    {
        return Excel::download(new BukuExport, 'Daftar-Buku.xlsx');
    }   

    public function exportBukuPdf($cari = null)
    {
        $buku = Buku_model::getBuku($cari);
        $pdf = PDF::loadview('admin.export-buku', compact('buku'))->setPaper('a4', 'landscape');
        return $pdf->download('daftar-buku.pdf');
    }

    public function refreshBuku()
    {
        session()->forget('cari');
        return redirect('daftarBuku');
    }

    public function dataPetugas(Request $request)
    {
        if($request->cari != '') {
            $cari = $request->cari;
            $request->session()->put('cari', $cari);
        }else{
            $cari = $request->session()->get('cari');
        }

        $petugas = PetugasModel::getPetugas($cari);
        return view('admin.data-petugas', compact('petugas'));
    }

    public function hapusPetugas(Request $request)
    {
        foreach ($request->id as $id) {
            $image = User::where('id', $id)->first();
            if ($image->image != 'default.png') {
                File::delete('img/user_img/' . $image->image);
            }

            PetugasModel::where('id', $id)->delete();
        }
        return redirect('dataPetugas')->with('status', 'Data petugas berhasil dihapus.');
    }

    public function refreshPetugas()
    {
        session()->forget('cari');
        return redirect('/dataPetugas');
    }

    public function exportPetugasExcel()
    {
        return Excel::download(new PetugasExport, 'Data Petugas.xlsx');
    }

    public function exportPetugasPdf($cari = '')
    {
        $petugas = PetugasModel::getPetugas($cari);
        $pdf = PDF::loadview('admin.export-petugas', compact('petugas'))->setPaper('a4', 'landscape');
        return $pdf->download('Data Petugas.pdf');
    }
}
