@extends('layout.template')
@extends('layout.nav-anggota')
@section('title', 'Dashboard | Fiore Library')
@section('css', 'anggota.css')
@section('content')
<div class="main">
  <h5><a href="/dashboardAnggota">Dashboard</a> / Harus Dikembalikan</h5>
  <div class="divider-dipinjam"></div>
  <div class="data-history-peminjaman">
    <div class="btn-export-group-history">
      <a href="/exportHarusDikembalikanExcel" class="btn btn-daftar-buku btn-export" onclick="return confirm('Yakin ingin mengexport data buku yang harus dikembalikan?')"><i class="fa fa-fw fa-download"></i>Excel</a>
      <a href="/exportHarusDikembalikanPdf" class="btn btn-daftar-buku btn-export" onclick="return confirm('Yakin ingin mengexport data buku yang harus dikembalikan?')"><i class="fa fa-fw fa-download"></i>PDF</a>
    </div>
    <table class="table table-history">
      <thead>
        <tr>
          <th scope="col">Kode Peminjaman</th>
          <th scope="col">Judul</th>
          <th scope="col">Qty</th>
          <th scope="col">Harus Kembali</th>
          <th scope="col">Terlambat</th>
        </tr>
      </thead>
      <tbody>
        @foreach($hrs_dikembalikan as $hd)
        <?php
        $tgl_hrs_kembali = $hd->tgl_hrs_kembali;
        $now = date('Y-m-d');
        if ($tgl_hrs_kembali == $now) {
          $terlambat = '-';
          $hrs_kembali = 'Hari Ini';
          $text_danger = 'text-danger';
        } elseif ($tgl_hrs_kembali > $now) {
          $terlambat = '-';
          $hrs_kembali = $tgl_hrs_kembali;
          $text_danger = '';
        } else {
          $hrs_kembali = $hd->tgl_hrs_kembali;
          $tgl_hrs_kembali = new DateTime($tgl_hrs_kembali);
          $now = new DateTime();
          $terlambat = $now->diff($tgl_hrs_kembali)->d . ' Hari';
          $text_danger = '';
        }
        ?>
        <tr>
          <th scope="row">PMJ{{str_pad($hd->id_peminjaman, 4, 0, STR_PAD_LEFT)}}</th>
          <td>{{$hd->judul}}</td>
          <td>{{$hd->qty}}</td>
          <td class="{{$text_danger}}">{{$hrs_kembali}}</td>
          <td>{{$terlambat}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('.table-history').DataTable();
  })
</script>
@endsection