@extends('layout.template')
@extends('layout.sidenav')
@section('css','admin.css')
@section('sidenavcss', 'sidenav.css')
@section('title', 'Laporan Peminjaman | Fiore Library')
@section('content')
<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-fw fa-clipboard"></i> Laporan Peminjaman</li>
    </ol>
  </nav>
  <div class="laporan-peminjaman-table">
    <a href="/exportLaporanPeminjamanExcel" class="btn btn-daftar-buku btn-export" onclick="return confirm('Yakin ingin mengexport laporan peminjaman?')"><i class="fa fa-fw fa-download"></i>Excel</a>
    <a href="/exportLaporanPeminjamanPdf/{{session('cari')}}" class="btn btn-daftar-buku btn-export" onclick="return confirm('Yakin ingin mengexport laporan peminjaman?')"><i class="fa fa-fw fa-download"></i>PDF</a>
    <table class="table table-daftar-buku" id="table-daftar-buku">
      <thead class="table-orange">
        <tr>
          <th scope="col">Tanggal</th>
          <th scope="col">Buku Dipinjam</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        @foreach($peminjaman as $index => $p)
        <tr>
          <td>{{$p->tgl_pinjam}}</td>
          <td>{{$p->buku_dipinjam}} &nbsp Buku</td>
          <td>
            <a href="detailLaporanPeminjaman/{{$p->tgl_pinjam}}" class="badge bg-success">Detail</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @if(empty($peminjaman))
  <div class="alert alert-danger alert-not-found">
    Data peminjaman tidak ditemukan!
  </div>
  @endif
</div>

<script>
  $(document).ready(function() {
    $('#table-daftar-buku').DataTable();
  });
</script>
@endsection