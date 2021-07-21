@extends('layout.template')
@extends('layout.sidenav')
@section('css', 'petugas.css')
@section('sidenavcss', 'sidenav.css')
@section('js', 'daftar-buku-petugas.js')
@section('title', 'Daftar Buku | Fiore Library')
@section('content')
<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Daftar Buku</li>
    </ol>
  </nav>
  @if(session('status'))
  <div class="alert alert-success fade show" role="alert">
    {{session('status')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  @error('foto')
  <div class="alert alert-danger fade show" role="alert">
    {{$message}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  <a href="" class="btn btn-tambah-buku" data-bs-toggle="modal" data-bs-target="#tambahBukuModal"><i class="fa fa-fw fa-plus-circle"></i> Tambah</a>
  <table class="table table-buku-petugas">
    <thead class="table-orange">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Kode</th>
        <th scope="col">Judul</th>
        <th scope="col">Pengarang</th>
        <th scope="col">Penerbit</th>
        <th scope="col">Tahun Terbit</th>
        <th scope="col" class="column-foto">Foto</th>
        <th scope="col">Bahasa</th>
        <th scope="col">Genre</th>
        <th scope="col">Jumlah Halaman</th>
        <th scope="col">Stok</th>
      </tr>
    </thead>
    <tbody>
      @foreach($buku as $index => $b)
      <td>{{$index + $buku->firstItem()}}</td>
      <td>BK{{str_pad($b->id_buku, 4, '0', STR_PAD_LEFT)}}</td>
      <td>{{$b->judul}}</td>
      <td>{{$b->pengarang}}</td>
      <td>{{$b->penerbit}}</td>
      <td>{{$b->tahun_terbit}}</td>
      <td><img class="img-buku" src="/img/buku/{{$b->foto}}" alt=""></td>
      <td>{{$b->bahasa}}</td>
      <td>{{$b->genre}}</td>
      <td>{{$b->jml_halaman}}</td>
      <td>{{$b->stok}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{$buku->links()}}
</div>

<!-- Modal Tambah Buku-->
<div class="modal fade" id="tambahBukuModal" tabindex="-1" aria-labelledby="tambahBukuModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahBukuModalLabel">Tambah Buku Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="tambahBukuPetugas" method="post" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label for="judul" class="form-label">Judul<span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul') }}">
            <div class="invalid-feedback">
              Judul harus diisi!
            </div>
          </div>
          <div class="mb-3">
            <label for="pengarang" class="form-label">Pengarang<span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('pengarang') is-invalid @enderror" id="pengarang" name="pengarang" value="{{ old('pengarang') }}">
            <div class="invalid-feedback">
              Pengarang harus diisi!
            </div>
          </div>
          <div class="mb-3">
            <label for="penerbit" class="form-label">Penerbit<span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('penerbit') is-invalid @enderror" id="penerbit" name="penerbit" value="{{ old('penerbit') }}">
            <div class="invalid-feedback">
              Penerbit harus diisi!
            </div>
          </div>
          <div class="mb-3">
            <label for="tahun_terbit" class="form-label">Tahun Terbit<span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('tahun_terbit') is-invalid @enderror" id="tahun_terbit" name="tahun_terbit" value="{{ old('tahun_terbit') }}" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
            <div class="invalid-feedback">
              Tahun Terbit harus diisi!
            </div>
          </div>
          <div class="mb-3">
            <label for="bahasa" class="form-label">Bahasa<span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('bahasa') is-invalid @enderror" id="bahasa" name="bahasa" value="{{ old('bahasa') }}">
            <div class="invalid-feedback">
              Bahasa harus diisi!
            </div>
          </div>
          <div class="mb-3">
            <label for="genre" class="form-label">Genre<span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('genre') is-invalid @enderror" list="datalistOptions" id="genre" name="genre" value="{{ old('genre') }}">
            <datalist id="datalistOptions">
              <option value="Drama">
              <option value="Action">
              <option value="Comedy">
              <option value="Horror">
              <option value="Romance">
              <option value="Fantasy">
              <option value="Adventure">
              <option value="Thiller">
              <option value="Sci-Fi">
              <option value="Mistery">
              <option value="Documenter">
              <option value="Biografi">
            </datalist>
            <div class="invalid-feedback">
              Bahasa harus diisi!
            </div>
          </div>
          <div class="mb-3">
            <label for="jml_halaman" class="form-label">Jumlah Halaman<span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('jml_halaman') is-invalid @enderror" id="jml_halaman" name="jml_halaman" value="{{ old('jml_halaman') }}" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
            <div class="invalid-feedback">
              Jumlah Halaman harus diisi!
            </div>
          </div>
          <div class="mb-3">
            <label for="foto" class="form-label">Foto Buku</label>
            <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto">
          </div>
          <div class="mb-3">
            <label for="stok" class="form-label">Stok<span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('stok') is-invalid @enderror" id="stok" name="stok" value="{{ old('stok') }}" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
            <div class="invalid-feedback">
              Stok harus diisi!
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-tambah-buku" id="btn-tambah" onclick="return confirm('Yakin ingin menambahkan buku baru?')" disabled>Simpan</button>
        <button class="btn btn-tambah-buku" id="btn-disabled" disabled>Tunggu ....</button>
      </div>
    </div>
    </form>
  </div>
</div>
@endsection