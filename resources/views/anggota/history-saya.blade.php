@extends('layout.template')
@extends('layout.nav-anggota')
@section('title', 'History Peminjaman | Fiore Library')
@section('css', 'anggota.css')
@section('content')
<div class="main">
  <h5>History Peminjaman</h5>
  <div class="divider-history"></div>
  <div class="btn-export-group-history">
    <a href="/exportHistorySayaExcel" class="btn btn-daftar-buku btn-export" onclick="return confirm('Yakin ingin mengexport history pengembalian?')"><i class="fa fa-fw fa-download"></i>Excel</a>
    <a href="/exportHistorySayaPdf" class="btn btn-daftar-buku btn-export" onclick="return confirm('Yakin ingin mengexport history pengembalian?')"><i class="fa fa-fw fa-download"></i>PDF</a>
  </div>
  <div class="data-history-peminjaman">
    <table class="table table-history">
      <thead>
        <tr>
          <th scope="col">Kode Pengembalian</th>
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
</div>

<script>
  $('.table-history').DataTable();
</script>
@endsection