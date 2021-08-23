@extends('layout.template')
@extends('layout.sidenav')
@section('css','petugas.css')
@section('sidenavcss', 'sidenav.css')
@section('title', 'Buku Ditambahkan Petugas | Fiore Library')
@section('content')
<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item" aria-current="page"><a href="/dashboardPetugas" class="prev"><i class="fa fa-fw fa-home"></i> Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Buku Ditambahkan</li>
    </ol>
  </nav>
  <div class="laporan-peminjaman-table">
    <a href="/exportBukuDitambahkanExcel" class="btn btn-daftar-buku btn-export" onclick="return confirm('Yakin ingin mengexport laporan buku ditambahkan?')"><i class="fa fa-fw fa-download"></i>Excel</a>
    <a href="/exportBukuDitambahkanPdf" class="btn btn-daftar-buku btn-export" onclick="return confirm('Yakin ingin mengexport laporan buku ditambahkan?')"><i class="fa fa-fw fa-download"></i>PDF</a>
    <table class="table table-daftar-buku" id="table-daftar-buku">
      <thead class="table-orange">
        <tr>
          <th scope="col">Kode</th>
          <th scope="col">Judul</th>
          <th scope="col">Pengarang</th>
          <th scope="col">Stok</th>
          <th scope="col">Created at</th>
          <th scope="col" class="column-foto">Foto</th>
        </tr>
      </thead>
      <tbody>
        @foreach($buku as $b)
        <tr>
          <td>BK{{str_pad($b->id_buku, 4, 0, STR_PAD_LEFT)}}</td>
          <td>{{$b->judul}}</td>
          <td>{{$b->pengarang}}</td>
          <td>{{$b->stok}}</td>
          <td>{{$b->created_at}}</td>
          <td><img class="img-buku" src="/img/buku/{{$b->foto}}" alt=""></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#table-daftar-buku').DataTable();
  });
</script>
@endsection