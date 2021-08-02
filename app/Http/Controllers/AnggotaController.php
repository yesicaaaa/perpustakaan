<?php

namespace App\Http\Controllers;

use App\Models\Buku_model;
use Illuminate\Http\Request;

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
}
