@extends('layout.template')
@extends('layout.sidenav')
@section('css','admin.css')
@section('sidenavcss', 'sidenav.css')
@section('title', 'Laporan Peminjaman | Fiore Library')
@section('content')
<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item" aria-current="page"><a href="/laporanPeminjaman" class="prev">Laporan Peminjaman</a></li>
      <li class="breadcrumb-item active" aria-current="page">Detail</li>
    </ol>
  </nav>
  <div class="laporan-peminjaman-table">
    <a href="/exportLaporanPeminjamanExcel" class="btn btn-daftar-buku btn-export" onclick="return confirm('Yakin ingin mengexport laporan peminjaman?')"><i class="fa fa-fw fa-download"></i>Excel</a>
    <a href="/exportLaporanPeminjamanPdf/{{session('cari')}}" class="btn btn-daftar-buku btn-export" onclick="return confirm('Yakin ingin mengexport laporan peminjaman?')"><i class="fa fa-fw fa-download"></i>PDF</a>
    <table class="table table-daftar-buku">
      <thead class="table-orange">
        <tr>
          <th scope="col">Kode</th>
          <th scope="col">Nama</th>
          <th scope="col">Judul</th>
          <th scope="col">Jumlah</th>
          <th scope="col">Perpanjangan</th>
          <th scope="col">Harus Kembali</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach($detail as $index => $d)
        <?php 
          $perpanjangan = ($d->perpanjang_pinjam != null) ? $d->perpanjang_pinjam . ' Hari' : '-';
        ?>
        <tr>
          <td>PMJ{{str_pad($d->id_peminjaman, 5, 0, STR_PAD_LEFT)}}</td>
          <td>{{$d->name}}</td>
          <td>{{$d->judul}}</td>
          <td>{{$d->qty}}</td>
          <td>{{$perpanjangan}}</td>
          <td>{{$d->tgl_hrs_kembali}}</td>
          <td>{{$d->status}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('.table-daftar-buku').DataTable();
  })
</script>
@endsection