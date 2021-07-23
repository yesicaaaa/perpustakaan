@extends('layout.template')
@extends('layout.sidenav')
@section('css', 'petugas.css')
@section('sidenavcss', 'sidenav.css')
@section('title', 'Data Peminjaman | Fiore Library')
@section('content')
<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Data Peminjaman</li>
    </ol>
  </nav>
  <div class="form-peminjaman">
    <div class="row">
      <div class="col-md-6 catat-peminjaman">
        <h6>Catat Peminjaman</h6>
        <form action="/tambahPeminjaman" method="post">
          @csrf
          <div class="mb-3">
            <label for="name" class="form-label">Nama Peminjam<span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" list="anggotaDatalist" id="name" name="name" value="{{ old('name') }}" autocomplete="off">
            <datalist id="anggotaDatalist">
              @foreach($anggota as $a)
              <option value="{{$a->id}}">{{$a->name}}</option>
              @endforeach
            </datalist>
            <div class="invalid-feedback">
              @error('name')
              {{ $message }}
              @enderror
            </div>
          </div>
          <div class="mb-3">
            <label for="id_buku" class="form-label">ID Buku<span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('id_buku') is-invalid @enderror" list="bukuDatalist" id="id_buku" name="id_buku" value="{{ old('id_buku') }}" autocomplete="off">
            <datalist id="bukuDatalist">
              @foreach($buku as $b)
              <option value="{{$b->id_buku}}">{{$b->judul}}</option>
              @endforeach
            </datalist>
            <div class="invalid-feedback">
              @error('id_buku')
              {{ $message }}
              @enderror
            </div>
          </div>
          <div class="mb-3">
            <label for="tgl_pinjam" class="form-label">Tanggal Pinjam<span class="text-danger">*</span></label>
            <input type="date" class="form-control @error('tgl_pinjam') is-invalid @enderror" id="tgl_pinjam" name="tgl_pinjam" value="{{ old('tgl_pinjam') }}">
            <div class="invalid-feedback">
              @error('tgl_pinjam')
              {{ $message }}
              @enderror
            </div>
          </div>
          <div class="mb-3">
            <label for="tgl_hrs_kembali" class="form-label">Tanggal Harus Kembali<span class="text-danger">*</span></label>
            <input type="date" class="form-control @error('tgl_hrs_kembali') is-invalid @enderror" id="tgl_hrs_kembali" name="tgl_hrs_kembali" value="{{ old('tgl_hrs_kembali') }}">
            <div class="invalid-feedback">
              @error('tgl_hrs_kembali')
              {{ $message }}
              @enderror
            </div>
          </div>
        </form>
      </div>
      <div class="col-md-6">
        <h6>Perpanjang Peminjaman</h6>
        @if($peminjaman)
        <form action="/perpanjangPeminjaman" method="post">
          @csrf
          <div class="mb-3">
            <label for="name" class="form-label">ID Peminjam<span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="name" value="{{ $peminjaman->name }}" readonly>
          </div>
          <div class="mb-3">
            <label for="judul" class="form-label">Judul Buku<span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="judul" value="{{ $peminjaman->judul }}" readonly>
          </div>
          <div class="mb-3">
            <label for="tgl_pinjam" class="form-label">Tanggal Pinjam<span class="text-danger">*</span></label>
            <input type="date" class="form-control" name="tgl_pinjam" value="{{ $peminjaman->tgl_pinjam }}" readonly>
          </div>
          <div class="mb-3">
            <label for="tgl_hrs_kembali" class="form-label">Tanggal Harus Kembali<span class="text-danger">*</span></label>
            <input type="date" class="form-control" name="tgl_hrs_kembali" value="{{ $peminjaman->tgl_hrs_kembali }}">
          </div>
          <div class="mb-3">
            <label for="perpanjang_pinjam" class="form-label">Perpanjang Peminjaman<span class="text-danger">*</span></label>
            <input type="number" class="form-control" name="perpanjang_pinjam" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
          </div>
        </form>
        @endif
      </div>
    </div>
  </div>
</div>
</div>
@endsection