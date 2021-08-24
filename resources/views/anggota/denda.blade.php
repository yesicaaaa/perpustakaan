@extends('layout.template')
@extends('layout.nav-anggota')
@section('title', 'Dashboard | Fiore Library')
@section('css', 'anggota.css')
@section('content')
<div class="main">
  <h5><a href="/dashboardAnggota">Dashboard</a> / Denda</h5>
  <div class="divider-dipinjam"></div>
  <div class="data-history-peminjaman">
    <div class="btn-export-group-history">
      <a href="/exportDendaSayaExcel" class="btn btn-daftar-buku btn-export" onclick="return confirm('Yakin ingin mengexport semua denda peminjaman?')"><i class="fa fa-fw fa-download"></i>Excel</a>
      <a href="/exportDendaSayaPdf" class="btn btn-daftar-buku btn-export" onclick="return confirm('Yakin ingin mengexport semua denda peminjaman?')"><i class="fa fa-fw fa-download"></i>PDF</a>
    </div>
    <table class="table table-history">
      <thead>
        <tr>
          <th scope="col">Kode Pengembalian</th>
          <th scope="col">Pengembalian</th>
          <th scope="col">Terlambat</th>
          <th scope="col">Denda</th>
          <th scope="col">Petugas</th>
        </tr>
      </thead>
      <tbody>
        @foreach($denda as $d)
        <tr>
          <th scope="row">PGM{{str_pad($d->id_pengembalian, 4, 0, STR_PAD_LEFT)}}</th>
          <td>{{$d->tgl_kembali}}</td>
          <td>{{$d->terlambat}} Hari</td>
          <td>{{$d->denda}}</td>
          <td>{{$d->name}}</td>
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