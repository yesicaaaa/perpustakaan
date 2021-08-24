@extends('layout.template')
@extends('layout.nav-anggota')
@section('title', 'Dashboard | Fiore Library')
@section('css', 'anggota.css')
@section('content')
<div class="main">
  <h5><a href="/dashboardAnggota">Dashboard</a> / Buku Dipinjam</h5>
  <div class="divider-dipinjam"></div>
  <div class="btn-export-group-history">
    <a href="/exportSemuaPeminjamanSayaExcel" class="btn btn-daftar-buku btn-export" onclick="return confirm('Yakin ingin mengexport semua peminjaman?')"><i class="fa fa-fw fa-download"></i>Excel</a>
    <a href="/exportSemuaPeminjamanSayaPdf" class="btn btn-daftar-buku btn-export" onclick="return confirm('Yakin ingin mengexport semua peminjaman?')"><i class="fa fa-fw fa-download"></i>PDF</a>
  </div>
  <div class="data-history-peminjaman">
    <table class="table table-history">
      <thead>
        <tr>
          <th scope="col">Kode Peminjaman</th>
          <th scope="col">Judul</th>
          <th scope="col">Qty</th>
          <th scope="col">Peminjaman</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach($peminjaman as $p)
        <tr>
          <th scope="row">PMJ{{str_pad($p->id_peminjaman, 4, 0, STR_PAD_LEFT)}}</th>
          <td>{{$p->judul}}</td>
          <td>{{$p->qty}}</td>
          <td>{{$p->tgl_pinjam}}</td>
          <td>{{$p->status}}</td>
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