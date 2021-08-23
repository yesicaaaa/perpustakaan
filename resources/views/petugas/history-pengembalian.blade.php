@extends('layout.template')
@extends('layout.sidenav')
@section('css', 'petugas.css')
@section('sidenavcss', 'sidenav.css')
@section('title', 'History Pengembalian | Fiore Library')
@section('content')
<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-fw fa-history"></i> History Pengembalian</li>
    </ol>
  </nav>
  <div class="laporan-peminjaman-table">
    <a href="/exportHistoryPengembalianPetugasExcel" class="btn btn-daftar-buku btn-export" onclick="return confirm('Yakin ingin mengexport history pengembalian?')"><i class="fa fa-fw fa-download"></i>Excel</a>
    <a href="/exportHistoryPengembalianPetugasPdf" class="btn btn-daftar-buku btn-export" onclick="return confirm('Yakin ingin mengexport history pengembalian?')"><i class="fa fa-fw fa-download"></i>PDF</a>
    <table class="table table-striped table-bordered data-buku history-pengembalian">
      <thead class="table-orange">
        <tr>
          <th>Kode Peminjaman</th>
          <th>Nama</th>
          <th>Harus Kembali</th>
          <th>Pengembalian</th>
          <th>Terlambat</th>
          <th>Denda</th>
        </tr>
      </thead>
      <tbody>
        @foreach($historyPengembalian as $hp)
        <tr>
          <td>PMJ{{str_pad($hp->id_peminjaman, 4, 0, STR_PAD_LEFT)}}</td>
          <td>{{$hp->name}}</td>
          <td>{{$hp->tgl_hrs_kembali}}</td>
          <td>{{$hp->tgl_kembali}}</td>
          <td>{{($hp->terlambat != null) ? $hp->terlambat . ' Hari' : '-'}}</td>
          <td>{{($hp->denda != null) ? 'Rp' . number_format($hp->denda, 0, ',', '.') : '-'}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('.history-pengembalian').DataTable();
  })
</script>
@endsection