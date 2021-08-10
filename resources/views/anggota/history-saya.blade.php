@extends('layout.template')
@extends('layout.nav-anggota')
@section('title', 'History Peminjaman | Fiore Library')
@section('css', 'anggota.css')
@section('content')
<div class="main">
  <h5>History Peminjaman</h5>
  <div class="divider-history"></div>
  <table class="table table-history">
    <thead>
      <tr>
        <th scope="col">Kode</th>
        <th scope="col">Judul</th>
        <th scope="col">Qty</th>
        <th scope="col">Harus Kembali</th>
        <th scope="col">Kembali</th>
        <th scope="col">Terlambat</th>
        <th scope="col">Denda</th>
        <th scope="col">Petugas</th>
      </tr>
    </thead>
    <tbody>
      @foreach($history as $h)
      <?php
      $terlambat = ($h->terlambat != null) ? $h->terlambat . ' Hari' : '-';
      $denda = ($h->denda != null) ? 'Rp' . number_format($h->denda, 0, ',', '.') : '-';
      ?>
      <tr>
        <th scope="row">PGM{{str_pad($h->id_pengembalian, 4, 0, STR_PAD_LEFT)}}</th>
        <td>{{$h->judul}}</td>
        <td>{{$h->qty}}</td>
        <td>{{$h->tgl_hrs_kembali}}</td>
        <td>{{$h->tgl_kembali}}</td>
        <td>{{$terlambat}}</td>
        <td>{{$denda}}</td>
        <td>{{$h->name}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<script>
  $('.table-history').DataTable();
</script>
@endsection