@extends('layout.template')
@extends('layout.nav-anggota')
@section('title', 'Dashboard | Fiore Library')
@section('css', 'anggota.css')
@section('content')
<div class="main">
  <h5>Dashboard</h5>
  <div class="divider-history"></div>
  <div class="row daftar-jumlah">
    <div class="col-md-3">
      <div class="jml-buku">
        <div class="row">
          <div class="col-md-8">
            <h1>{{$peminjaman}}+</h1>
            <p>Buku Dipinjam</p>
          </div>
          <div class="col-md-4">
            <i class="fa fa-fw fa-book"></i>
          </div>
        </div>
        <a href="/bukuDipinjam/{{Auth::user()->id}}">Lihat <i class="fa fa-fw fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-md-3">
      <div class="jml-dikembalikan">
        <div class="row">
          <div class="col-md-8">
            <h1>{{$pengembalian['jml_buku']}}+</h1>
            <p>Buku Dikembalikan</p>
          </div>
          <div class="col-md-4">
            <i class="fa fa-fw fa-inbox"></i>
          </div>
        </div>
        <a href="/historySaya/{{Auth::user()->id}}">Lihat <i class="fa fa-fw fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-md-3">
      <div class="jml-hrs-dikembalikan">
        <div class="row">
          <div class="col-md-8">
            <h1>{{$hrs_dikembalikan}}+</h1>
            <p>Harus Dikembalikan</p>
          </div>
          <div class="col-md-4">
            <i class="fa fa-fw fa-book"></i>
          </div>
        </div>
        <a href="/harusDikembalikan/{{Auth::user()->id}}">Lihat <i class="fa fa-fw fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-md-3">
      <div class="jml-pengembalian">
        <div class="row">
          <div class="col-md-8">
            <h3>Rp{{number_format($denda['denda'], 0, ',', '.')}}</h3>
            <p>Denda Dibayar</p>
          </div>
          <div class="col-md-4">
            <i class="fa fa-fw fa-money"></i>
          </div>
        </div>
        <a href="/dataPengembalian">Lihat <i class="fa fa-fw fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>
</div>
@endsection