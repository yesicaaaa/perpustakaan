@extends('layout.template')
@extends('layout.sidenav')
@section('css','admin.css')
@section('sidenavcss', 'sidenav.css')
@section('title', 'Laporan Pengembalian | Fiore Library')
@section('content')
<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Laporan Pengembalian</li>
    </ol>
  </nav>
  <div class="laporan-pengembalian-table">
    <a href="/exportLaporanPengembalianExcel" class="btn btn-daftar-buku btn-export" onclick="return confirm('Yakin ingin mengexport laporan pengembalian?')"><i class="fa fa-fw fa-download"></i>Excel</a>
    <a href="/exportLaporanPengembalianPdf/{{session('cari')}}" class="btn btn-daftar-buku btn-export" onclick="return confirm('Yakin ingin mengexport laporan pengembalian?')"><i class="fa fa-fw fa-download"></i>PDF</a>
    <table class="table table-daftar-buku" id="table-laporan-pengembalian">
      <thead class="table-orange">
        <tr>
          <th scope="col">Tanggal</th>
          <th scope="col">Buku Dikembalikan</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        @foreach($pengembalian as $index => $p)
        <tr>
          <td>{{$p->tgl_kembali}}</td>
          <td>{{$p->buku_dikembalikan}} &nbsp Buku</td>
          <td>
            <a href="detailLaporanPengembalian/{{$p->tgl_kembali}}" class="badge bg-success">Detail</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#table-laporan-pengembalian').DataTable();
  })
</script>
@endsection