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
            <h1>{{($peminjaman != null) ? $peminjaman . '+' : '0'}}</h1>
            <p>Buku Dipinjam</p>
          </div>
          <div class="col-md-4">
            <i class="fa fa-fw fa-book"></i>
          </div>
        </div>
        <a href="/bukuDipinjam">Lihat <i class="fa fa-fw fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-md-3">
      <div class="jml-dikembalikan">
        <div class="row">
          <div class="col-md-8">
            <h1>{{($pengembalian['jml_buku'] != null) ? $pengembalian['jml_buku'] . '+' : '0'}}</h1>
            <p>Buku Dikembalikan</p>
          </div>
          <div class="col-md-4">
            <i class="fa fa-fw fa-inbox"></i>
          </div>
        </div>
        <a href="/historySaya">Lihat <i class="fa fa-fw fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-md-3">
      <div class="jml-hrs-dikembalikan">
        <div class="row">
          <div class="col-md-8">
            <h1>{{($hrs_dikembalikan != null) ? $hrs_dikembalikan . '+' : '0'}}</h1>
            <p>Harus Dikembalikan</p>
          </div>
          <div class="col-md-4">
            <i class="fa fa-fw fa-book"></i>
          </div>
        </div>
        <a href="/peminjamanSaya">Lihat <i class="fa fa-fw fa-arrow-circle-right"></i></a>
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
        <a href="/dendaAnggota">Lihat <i class="fa fa-fw fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 most-book">
      <h5>Sering dipinjam</h5>
      <div class="row">
        <div class="col-md-3">
          <img src="/img/buku/{{$most_book['foto']}}" alt="">
        </div>
        <div class="col-md-9">
          <table class="table table-bordered">
            <tr>
              <th>Judul</th>
              <td>{{$most_book['judul']}}</td>
            </tr>
            <tr>
              <th>Bahasa</th>
              <td>{{$most_book['bahasa']}}</td>
            </tr>
            <tr>
              <th>Genre</th>
              <td>{{$most_book['genre']}}</td>
            </tr>
            <tr>
              <th>Halaman</th>
              <td>{{$most_book['jml_halaman']}}</td>
            </tr>
            <tr>
              <th>Jumlah Dipinjam</th>
              <td>{{$most_book['most_qty']}}</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-6 svg-illust">
      <img src="/img/most_book.svg" alt="">
    </div>
  </div>
</div>
@endsection