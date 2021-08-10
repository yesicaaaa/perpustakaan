@extends('layout.template')
@extends('layout.sidenav')
@section('css', 'admin.css')
@section('sidenavcss', 'sidenav.css')
@section('title', 'Dashboard | Fiore Library')
@section('content')
<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-fw fa-home"></i> Dashboard</li>
    </ol>
  </nav>
  <div class="row daftar-jumlah">
    <div class="col-md-3">
      <div class="jml-buku">
        <div class="row">
          <div class="col-md-8">
            <h1>{{$buku}}+</h1>
            <p>Buku</p>
          </div>
          <div class="col-md-4">
            <i class="fa fa-fw fa-book"></i>
          </div>
        </div>
        <a href="/daftarBukuPetugas">Lihat <i class="fa fa-fw fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-md-3">
      <div class="jml-user">
        <div class="row">
          <div class="col-md-8">
            <h1>{{$anggota['jml_anggota']}}+</h1>
            <p>Anggota</p>
          </div>
          <div class="col-md-4">
            <i class="fa fa-fw fa-user-plus"></i>
          </div>
        </div>
        <a href="/dataAnggotaPetugas">Lihat <i class="fa fa-fw fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-md-3">
      <div class="jml-peminjaman">
        <div class="row">
          <div class="col-md-8">
            <h1>{{$peminjaman}}+</h1>
            <p>Peminjaman</p>
          </div>
          <div class="col-md-4">
            <i class="fa fa-fw fa-inbox"></i>
          </div>
        </div>
        <a href="/dataPeminjaman">Lihat <i class="fa fa-fw fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-md-3">
      <div class="jml-pengembalian">
        <div class="row">
          <div class="col-md-8">
            <h1>{{$pengembalian}}+</h1>
            <p>Pengembalian</p>
          </div>
          <div class="col-md-4">
            <i class="fa fa-fw fa-inbox"></i>
          </div>
        </div>
        <a href="/dataPengembalian">Lihat <i class="fa fa-fw fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>
</div>
@endsection