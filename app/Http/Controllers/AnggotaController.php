<?php

namespace App\Http\Controllers;

use App\Exports\DendaSayaExport;
use App\Exports\HistorySayaExport;
use App\Exports\PeminjamanSayaExport;
use App\Exports\SemuaPeminjamanSayaExport;
use App\Models\Buku_model;
use App\Models\PeminjamanModel;
use App\Models\PengembalianModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade AS PDF;

class AnggotaController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $url = 'dashboard';
        $peminjaman = PeminjamanModel::where('id_anggota', $id)->sum('qty');
        $pengembalian = PengembalianModel::getJumlahBukuPengembalian($id);
        $hrs_dikembalikan = PeminjamanModel::getBukuHrsDikembalikan($id);
        $denda = PengembalianModel::getTotalDenda($id);
        $most_book = PengembalianModel::getPeminjamanTerbanyak($id);
        return view('anggota.dashboard', compact('url', 'peminjaman', 'pengembalian', 'hrs_dikembalikan', 'denda', 'most_book'));
    }

    public function daftarBuku()
    {
        $url = 'daftarBuku';
        $buku = Buku_model::all();
        return view('anggota.daftar-buku', compact('url', 'buku'));
    }

    public function cariBukuAnggota(Request $request)
    {
        $output = '';
        $buku = Buku_model::getBukuAnggota($request->cari);
        foreach($buku as $b) {
            $null = ($b->stok < 1) ? 'out-stok' : '';
            $output .= '
            <div class="col-md-3 ' . $null . ' list-buku">
                <img src="/img/buku/'. $b->foto .'" alt="">
                <h6>'.$b->judul . '</h5>
                <p>Pengarang ' . $b->pengarang . '</p>
            <div class="desc-buku" id="desc_buku">
                <table class="table table-bordered">
                    <tr>
                        <th>Penerbit</th>
                        <td>'.$b->penerbit. '</td>
                    </tr>
                    <tr>
                        <th>Tahun Terbit</th>
                        <td>' . $b->tahun_terbit . '</td>
                    </tr>
                    <tr>
                        <th>Bahasa</th>
                        <td>' . $b->bahasa . '</td>
                    </tr>
                    <tr>
                        <th>Genre</th>
                        <td>' . $b->genre . '</td>
                    </tr>
                    <tr>
                        <th>Halaman</th>
                        <td>' . $b->jml_halaman . '</td>
                    </tr>
                    <tr>
                        <th>Stok</th>
                        <td>' . $b->stok . '</td>
                    </tr>
                </table>
            </div>
            </div>';
        }

        echo json_encode($output);
    }

    public function peminjamanSaya()
    {
        $id = Auth::user()->id;
        $peminjamanSaya = PeminjamanModel::getPeminjamanSaya($id);
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

        date_default_timezone_set('Asia/Jakarta');
        $perpanjang_pinjam = $request->perpanjang_pinjam;
        $tgl_hrs_kembali = date('Y-m-d', strtotime('+' . $perpanjang_pinjam . ' days', strtotime($request->tgl_hrs_kembali)));
        $perpanjangan = PeminjamanModel::where('id_peminjaman', $request->id_peminjaman)->first();
        $hrs_kembali = strtotime($request->tgl_hrs_kembali);
        $now = date('Y-m-d');

        if($perpanjangan->perpanjang_pinjam != null)
        {
            return redirect('/peminjamanSaya')->with('err', 'Perpanjangan pinjam sudah pernah dilakukan!');
        }elseif($hrs_kembali <= $now) {
            return redirect('/peminjamanSaya')->with('err', 'Buku sudah harus dikembalikan!');
        }else{
            DB::table('peminjaman')->where('id_peminjaman', $request->id_peminjaman)->update([
                'perpanjang_pinjam' => $perpanjang_pinjam,
                'tgl_hrs_kembali'   => $tgl_hrs_kembali,
                'updated_at'    => date('Y-m-d G:i:s')
            ]);
            return redirect('/peminjamanSaya')->with('status', 'Perpanjangan pinjam buku berhasil');
        }
    }

    public function cariPeminjamanAnggota(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $output = '';
        $peminjamanSaya = PeminjamanModel::getPeminjamanSaya($request->id, $request->cari);
        if($peminjamanSaya != null) {
            foreach($peminjamanSaya as $ps)
            {
                $hrs_kembali = strtotime($ps->tgl_hrs_kembali);
                $now = strtotime(date('Y-m-d'));
                $kembalikan = ($hrs_kembali <= $now) ? 'text-danger' : 'text-success';
                $perpanjang_pinjam = ($ps->perpanjang_pinjam != null) ? $ps->perpanjang_pinjam : '-';
                $output .= '
                    <div class="col-md-4">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                        <div class="col-md-4">
                            <img src="/img/buku/'.$ps->foto.'" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                            <h6 class="card-title">'.$ps->judul.'</h6>
                            <p class="card-text">Peminjaman : <span>'.$ps->tgl_pinjam.'</span></p>
                            <p class="card-text '.$kembalikan.'">Harus Kembali : <span>'.$ps->tgl_hrs_kembali.'</span></p>
                            <p class="card-text">Perpanjangan Pinjam : <span>'.$perpanjang_pinjam. '</span> Hari</p>
                            <p class="card-text">Jumlah : <span>' . $ps->qty . '</span> Buku</p>
                            <a href="javascript:getData('.$ps->id_peminjaman.')" class="badge bg-success perpanjang-pinjam">Perpanjang Pinjam</a>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>';
            }
        }else{
            $output = '
            <p class="none-peminjaman">Tidak ada peminjaman</p>
            ';
        }
        echo json_encode($output);
    }

    public function historySaya()
    {
        $id = Auth::user()->id;
        $history = PeminjamanModel::getHistoryPeminjaman($id);
        $url = 'historySaya';
        return view('anggota.history-saya', compact('history', 'url'));
    }

    public function profileSaya()
    {
        $url = 'profileSaya';
        return view('anggota.profile-saya', compact('url'));
    }

    public function ubahProfileSaya(Request $request)
    {
        $request->validate([
            'phone' => 'required|max:13',
            'alamat'    => 'required'
        ]);

        $user = User::where('id', $request->id)->first();
        if($user->phone == $request->phone && $user->alamat == $request->alamat) {
            return redirect('/profileSaya')->with('err', 'Tidak ada perubahan apapun!');
        } else{
            date_default_timezone_set('Asia/Jakarta');
            DB::table('users')->where('id', $request->id)->update([
                'phone' => $request->phone,
                'alamat'    => $request->alamat,
                'updated_at'    => date('Y-m-d G:i:s')
            ]);
    
            return redirect('/profileSaya')->with('status', 'Profile berhasil diubah');
        }
    }

    public function bukuDipinjam()
    {
        $id = Auth::user()->id;
        $url = 'dashboard';
        $peminjaman = PeminjamanModel::getAllPeminjamanAnggota($id);
        return view('anggota.buku-dipinjam', compact('url', 'peminjaman'));
    }

    public function harusDikembalikan()
    {
        $id = Auth::user()->id;
        $url = 'dashboard';
        $hrs_dikembalikan = PeminjamanModel::getHarusDikembalikanAnggota($id);
        return view('anggota.harus-dikembalikan', compact('url', 'hrs_dikembalikan'));
    }

    public function dendaAnggota()
    {
        $id = Auth::user()->id;
        $url = 'dashboard';
        $denda = PengembalianModel::getDendaAnggota($id);
        return view('anggota.denda', compact('url', 'denda'));
    }

    public function exportPeminjamanSayaExcel()
    {
        $id = Auth::user()->id;
        $anggota = User::where('id', $id)->first();
        return Excel::download(new PeminjamanSayaExport($id), 'Data Peminjaman AGT[' . $anggota['name'] . '].xlsx');
    }

    public function exportPeminjamanSayaPdf()
    {
        $id = Auth::user()->id;
        $anggota = User::where('id', $id)->first();
        $peminjaman = PeminjamanModel::getPeminjamanSaya($id);
        $pdf = PDF::loadView('anggota.export-peminjaman-saya', compact('peminjaman'))->setPaper('a4');
        return $pdf->download('Data Peminjaman AGT[' . $anggota['name'] . '].pdf');
    }

    public function exportHistorySayaExcel()
    {
        $id = Auth::user()->id;
        $anggota = User::where('id', $id)->first();
        return Excel::download(new HistorySayaExport($id), 'History Pengembalian AGT[' . $anggota['name'] . '].xlsx');
    }

    public function exportHistorySayaPdf()
    {
        $id = Auth::user()->id;
        $anggota = User::where('id', $id)->first();
        $history = PeminjamanModel::getHistoryPeminjaman($id);
        $pdf = PDF::loadView('anggota.export-history-saya', compact('history'))->setPaper('a4');
        return $pdf->download('History Pengembalian AGT[' . $anggota['name'] . '].pdf');
    }

    public function exportSemuaPeminjamanSayaExcel()
    {
        $id = Auth::user()->id;
        $anggota = User::where('id', $id)->first();
        return Excel::download(new SemuaPeminjamanSayaExport($id), 'Data Semua Peminjaman AGT[' . $anggota['name'] . '].xlsx');
    }

    public function exportSemuaPeminjamanSayaPdf()
    {
        $id = Auth::user()->id;
        $anggota = User::where('id', $id)->first();
        $peminjaman = PeminjamanModel::getAllPeminjamanAnggota($id);
        $pdf = PDF::loadView('anggota.export-semua-peminjaman-saya', compact('peminjaman'))->setPaper('a4');
        return $pdf->download('Data Semua Peminjaman AGT[' . $anggota['name'] . '].pdf');
    }

    public function exportDendaSayaExcel()
    {
        $id = Auth::user()->id;
        $anggota = User::where('id', $id)->first();
        return Excel::download(new DendaSayaExport($id), 'Data Denda AGT[' . $anggota['name'] . '].xlsx');
    }

    public function exportDendaSayaPdf()
    {
        $id = Auth::user()->id;
        $anggota = User::where('id', $id)->first();
        $denda = PengembalianModel::getDendaAnggota($id);
        $pdf = PDF::loadView('anggota.export-denda-saya', compact('denda'))->setPaper('a4');
        return $pdf->download('Data Denda AGT[' . $anggota['name'] . '].pdf');
    }
}