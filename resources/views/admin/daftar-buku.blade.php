@extends('layout.template')
@extends('layout.sidenav')
@section('css', 'admin.css')
@section('sidenavcss', 'sidenav.css')
@section('title', 'Daftar Buku | Fiore Library')
@section('js', 'daftar_buku.js')
@section('content')
<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Daftar Buku</li>
    </ol>
  </nav>
  <div class="row daftar-buku">
    <div class="col-md-3 tambah-buku">
      <h6>Tambah Buku</h6>
      <form action="tambahBuku" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="judul" class="form-label">Judul<span>*</span></label>
          <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul') }}">
          <div class="invalid-feedback">
            @error('judul')
            {{ $message }}
            @enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="pengarang" class="form-label">Pengarang<span>*</span></label>
          <input type="text" class="form-control @error('pengarang') is-invalid @enderror" id="pengarang" name="pengarang" value="{{ old('pengarang') }}">
          <div class="invalid-feedback">
            @error('pengarang')
            {{ $message }}
            @enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="penerbit" class="form-label">Penerbit<span>*</span></label>
          <input type="text" class="form-control @error('penerbit') is-invalid @enderror" id="penerbit" name="penerbit" value="{{ old('penerbit') }}">
          <div class="invalid-feedback">
            @error('penerbit')
            {{ $message }}
            @enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="tahun_terbit" class="form-label">Tahun Terbit<span>*</span></label>
          <input type="text" class="form-control @error('tahun_terbit') is-invalid @enderror" id="tahun_terbit" name="tahun_terbit" value="{{ old('tahun_terbit') }}">
          <div class="invalid-feedback">
            @error('tahun_terbit')
            {{ $message }}
            @enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="bahasa" class="form-label">Bahasa<span>*</span></label>
          <input type="text" class="form-control @error('bahasa') is-invalid @enderror" id="bahasa" name="bahasa" value="{{ old('bahasa') }}">
          <div class="invalid-feedback">
            @error('bahasa')
            {{ $message }}
            @enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="genre" class="form-label">Genre<span>*</span></label>
          <input type="text" class="form-control @error('genre') is-invalid @enderror" id="genre" name="genre" value="{{ old('genre') }}">
          <div class="invalid-feedback">
            @error('genre')
            {{ $message }}
            @enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="jml_halaman" class="form-label">Jumlah Halaman<span>*</span></label>
          <input type="text" class="form-control @error('jml_halaman') is-invalid @enderror" id="jml_halaman" name="jml_halaman" value="{{ old('jml_halaman') }}">
          <div class="invalid-feedback">
            @error('jml_halaman')
            {{ $message }}
            @enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="stok" class="form-label">Stok<span>*</span></label>
          <input type="text" class="form-control @error('stok') is-invalid @enderror" id="stok" name="stok" value="{{ old('stok') }}">
          <div class="invalid-feedback">
            @error('stok')
            {{ $message }}
            @enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="foto" class="form-label">Foto Buku<span>*</span></label>
          <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto">
          <div class="invalid-feedback">
            @error('foto')
            {{ $message }}
            @enderror
          </div>
        </div>
        <button class="btn btn-tambah-buku" type="submit" disabled>Tambah</button>
      </form>
    </div>
    <div class="col-md-9">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">Handle</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>@fat</td>
          </tr>
          <tr>
            <th scope="row">3</th>
            <td colspan="2">Larry the Bird</td>
            <td>@twitter</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection