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
          <input type="text" class="form-control @error('tahun_terbit') is-invalid @enderror" id="tahun_terbit" name="tahun_terbit" value="{{ old('tahun_terbit') }}" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
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
          <input type="text" class="form-control @error('jml_halaman') is-invalid @enderror" id="jml_halaman" name="jml_halaman" value="{{ old('jml_halaman') }}" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
          <div class="invalid-feedback">
            @error('jml_halaman')
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
        <div class="mb-3">
          <label for="stok" class="form-label">Stok<span>*</span></label>
          <input type="text" class="form-control @error('stok') is-invalid @enderror" id="stok" name="stok" value="{{ old('stok') }}" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
          <div class="invalid-feedback">
            @error('stok')
            {{ $message }}
            @enderror
          </div>
        </div>
        <button class="btn btn-tambah-buku" type="submit" disabled>Tambah</button>
      </form>
    </div>
    <div class="col-md-9">
      @if(session('status'))
      <div class="alert alert-success">
        {{session('status')}}
      </div>
      @endif
      <form action="hapusBuku" method="post">
        @csrf
        <button type="submit" class="btn btn-danger btn-daftar-buku"><i class="fa fa-fw fa-minus-circle"></i> Hapus</button>
        <a href="" class="btn btn-success btn-daftar-buku btn-export"><i class="fa fa-fw fa-download"></i>Excel</a>
        <a href="" class="btn btn-danger btn-daftar-buku btn-export"><i class="fa fa-fw fa-download"></i>PDF</a>
        <table class="table table-daftar-buku">
          <thead class="table-orange">
            <tr>
              <th scope="col"></th>
              <th scope="col">#</th>
              <th scope="col">Kode</th>
              <th scope="col">Judul</th>
              <th scope="col" class="column-foto">Foto</th>
              <th scope="col">Stok</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($buku as $b)
            <tr>
              <th scope="row">
                <input type="checkbox" name="id[]" value="{{$b->id_buku}}">
      </form>
      </th>
      <td>{{$loop->iteration}}</td>
      <td>BK{{str_pad($b->id_buku, 4, '0', STR_PAD_LEFT)}}</td>
      <td>{{$b->judul}}</td>
      <td><img class="img-buku" src="/img/buku/{{$b->foto}}" alt=""></td>
      <td>{{$b->stok}}</td>
      <td>
        <a href="detailBuku/{{$b->id_buku}}" class="badge bg-success">Detail</a>
      </td>
      </tr>
      @endforeach
      </tbody>
      </table>
    </div>
  </div>
</div>

@endsection