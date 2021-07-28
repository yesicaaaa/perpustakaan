@extends('layout.template')
@extends('layout.sidenav')
@section('css', 'petugas.css')
@section('sidenavcss', 'sidenav.css')
@section('title', 'Detail Peminjaman | Fiore Library')
@section('content')
<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item breadcrumb-link" aria-current="page"><a href="/dataPeminjaman">Data Peminjaman</a></li>
      <li class="breadcrumb-item active" aria-current="page">Detail Peminjaman</li>
    </ol>
  </nav>
  <div class="data-peminjam">
    <div class="row">
      <div class="col-md-2">
        <img src="/img/user_img/{{$peminjaman->image}}" alt="">
      </div>
      <div class="col-md-6">
        <table class="table table-bordered table-detail-peminjaman">
          <tr>
            <th scope="col">Nama Lengkap</th>
            <td>{{$peminjaman->name}}</td>
          </tr>
          <tr>
            <th scope="col">Email</th>
            <td>{{$peminjaman->email}}</td>
          </tr>
          <tr>
            <th scope="col">No. Telepon</th>
            <td>{{$peminjaman->phone}}</td>
          </tr>
          <tr>
            <th scope="col">Alamat</th>
            <td>{{$peminjaman->alamat}}</td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <table class="table table-striped table-bordered data-peminjaman">
    <thead>
      <tr>
        <th>Kode</th>
        <th>Judul Buku</th>
        <th>Qty</th>
        <th>Tanggal Pinjam</th>
        <th>Perpanjangan Pinjam</th>
        <th>Tanggal Harus Kembali</th>
        <th>Nama Petugas</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>PMJ{{str_pad($peminjaman->id_peminjaman, 4, 0, STR_PAD_LEFT)}}</td>
        <td>{{$peminjaman->judul}}</td>
        <td>{{$peminjaman->qty}}</td>
        <td>{{$peminjaman->tgl_pinjam}}</td>
        <td>{{$peminjaman->perpanjang_pinjam}}</td>
        <td>{{$peminjaman->tgl_hrs_kembali}}</td>
        <td>{{$peminjaman->name}}</td>
        <td>{{$peminjaman->status}}</td>
    </tbody>
  </table>
</div>
@endsection