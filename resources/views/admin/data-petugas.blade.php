@extends('layout.template')
@extends('layout.sidenav')
@section('css','admin.css')
@section('sidenavcss', 'sidenav.css')
@section('title', 'Data Petugas | Fiore Library')
@section('content')
<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Data Petugas</li>
    </ol>
  </nav>
  <div class="row daftar-buku">
    <div class="col-md-3 tambah-buku">
      <h6>Tambah Petugas</h6>
      <form action="tambahPetugas" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="nama" class="form-label">Nama Lengkap<span>*</span></label>
          <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}">
          <div class="invalid-feedback">
            @error('nama')
            {{ $message }}
            @enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email<span>*</span></label>
          <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
          <div class="invalid-feedback">
            @error('email')
            {{ $message }}
            @enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="phone" class="form-label">No. Telepon<span>*</span></label>
          <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
          <div class="invalid-feedback">
            @error('phone')
            {{ $message }}
            @enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="alamat" class="form-label">Alamat<span>*</span></label>
          <textarea name="alamat" id="alamat" cols="30" rows="10">{{ old('alamat') }}</textarea>
          <div class="invalid-feedback">
            @error('alamat')
            {{ $message }}
            @enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="image" class="form-label">Foto<span>*</span></label>
          <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
          <div class="invalid-feedback">
            @error('image')
            {{ $message }}
            @enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password<span>*</span></label>
          <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
          <div class="invalid-feedback">
            @error('password')
            {{ $message }}
            @enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="confirm_password" class="form-label">Konfirmasi Password<span>*</span></label>
          <input type="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" id="confirm_password" name="confirm_password">
          <div class="invalid-feedback">
            @error('confirm_password')
            {{ $message }}
            @enderror
          </div>
        </div>
        <button class="btn btn-tambah-buku" onclick="return confirm('Yakin ingin menambahkan petugas baru?')" type="submit" disabled>Tambah</button>
      </form>
    </div>
    <div class="col-md-9">
      @if(session('status'))
      <div class="alert alert-success" role="alert">
        {{session('status')}}
        <button type="button" class="btn-close btn-close-alert" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
      <form action="hapusPetugas" method="post">
        @csrf
        <button type="submit" class="btn btn-danger btn-daftar-buku" id="hapus_buku" onclick="return confirm('Yakin ingin menghapus petugas?')"><i class="fa fa-fw fa-minus-circle"></i> Hapus</button>
        <a href="/exportBukuExcel" class="btn btn-success btn-daftar-buku btn-export" onclick="return confirm('Yakin ingin mengexport petugas?')"><i class="fa fa-fw fa-download"></i>Excel</a>
        <a href="/exportBukuPdf" class="btn btn-danger btn-daftar-buku btn-export" onclick="return confirm('Yakin ingin mengexport petugas?')"><i class="fa fa-fw fa-download"></i>PDF</a>
        <table class="table table-daftar-buku">
          <thead class="table-orange">
            <tr>
              <th scope="col"></th>
              <th scope="col">#</th>
              <th scope="col">Nama Lengkap</th>
              <th scope="col">Email</th>
              <th scope="col">No. Telepon</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($petugas as $p)
            <tr>
              <th scope="row">
                <input type="checkbox" name="id[]" id="id" value="{{$p->id}}">
      </form>
      </th>
      <td>{{$loop->iteration}}</td>
      <td>{{$p->nama}}</td>
      <td>{{$p->email}}</td>
      <td>{{$p->phone}}</td>
      <td>
        <a href="detailPetugas/{{$p->id}}" class="badge bg-success">Detail</a>
      </td>
      </tr>
      @endforeach
      </tbody>
      </table>
    </div>
  </div>
  </d @endsection