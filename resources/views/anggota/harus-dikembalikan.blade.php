@extends('layout.template')
@extends('layout.nav-anggota')
@section('title', 'Dashboard | Fiore Library')
@section('css', 'anggota.css')
@section('content')
<div class="main">
  <h5><a href="/dashboardAnggota/{{Auth::user()->id}}">Dashboard</a> / Harus Dikembalikan</h5>
  <div class="divider-dipinjam"></div>
  <table class="table table-history">
    <thead>
      <tr>
        <th scope="col">Kode</th>
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
      if($tgl_hrs_kembali == $now) {
        $terlambat = '-';
        $hrs_kembali = 'Hari Ini';
        $text_danger = 'text-danger';
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

<script>
  $(document).ready(function() {
    $('.table-history').DataTable();
  })
</script>
@endsection