@extends('layout.template')
@extends('layout.sidenav')
@section('css','admin.css')
@section('sidenavcss', 'sidenav.css')
@section('title', 'Data Denda | Fiore Library')
@section('content')
<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item" aria-current="page"><a href="/dataDenda" class="prev"><i class="fa fa-fw fa-money"></i> Data Denda</a></li>
      <li class="breadcrumb-item active" aria-current="page"> Detail Data Denda</li>
    </ol>
  </nav>
  <div class="laporan-peminjaman-table">
    <a href="/exportDetailDataDendaExcel/{{$id}}" class="btn btn-daftar-buku btn-export" onclick="return confirm('Yakin ingin mengexport data denda?')"><i class="fa fa-fw fa-download"></i>Excel</a>
    <a href="/exportDetailDataDendaPdf/{{$id}}" class="btn btn-daftar-buku btn-export" onclick="return confirm('Yakin ingin mengexport data denda?')"><i class="fa fa-fw fa-download"></i>PDF</a>
    <table class="table table-daftar-buku" id="table-daftar-buku">
      <thead class="table-orange">
        <tr>
          <th scope="col">Kode Pengembalian</th>
          <th scope="col">Kode Peminjaman</th>
          <th scope="col">Tanggal Kembali</th>
          <th scope="col">Terlambat</th>
          <th scope="col">Denda</th>
        </tr>
      </thead>
      <tbody>
        @foreach($denda as $d)
        <tr>
          <td>PGM{{str_pad($d->id_pengembalian, 4, 0, STR_PAD_LEFT)}}</td>
          <td>PMJ{{str_pad($d->id_peminjaman, 4, 0, STR_PAD_LEFT)}}</td>
          <td>{{$d->tgl_kembali}}</td>
          <td>{{($d->terlambat) ? $d->terlambat . ' hari' : '-'}}</td>
          <td>{{($d->denda) ? 'Rp' . number_format($d->denda, 0, ',', '.') : '-'}}</td>
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