@extends('layout.template')
@extends('layout.sidenav')
@section('css','admin.css')
@section('sidenavcss', 'sidenav.css')
@section('js', 'data-petugas.js')
@section('title', 'Data Petugas | Fiore Library')
@section('content')
<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-fw fa-address-book"></i> Data Petugas</li>
    </ol>
  </nav>
  <div class="row daftar-buku">
    <div class="col-md-3 tambah-buku tambah-petugas">
      <h6>Tambah Petugas</h6>
      <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="role" value="petugas">
        <div class="mb-3">
          <label for="nama" class="form-label">Nama Lengkap<span class="text-danger">*</span></label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" id="nama" name="name" value="{{ old('name') }}">
          <div class="invalid-feedback">
            @error('name')
            {{ $message }}
            @enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
          <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
          <div class="invalid-feedback">
            @error('email')
            {{ $message }}
            @enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="phone" class="form-label">No. Telepon<span class="text-danger">*</span></label>
          <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
          <div class="invalid-feedback">
            @error('phone')
            {{ $message }}
            @enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="alamat" class="form-label @error('alamat') is-invalid @enderror">Alamat<span class="text-danger">*</span></label>
          <textarea name="alamat" id="alamat" cols="30" rows="10">{{ old('alamat') }}</textarea>
          <div class="invalid-feedback">
            @error('alamat')
            {{ $message }}
            @enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="image" class="form-label">Foto</label>
          <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
          <div class="invalid-feedback">
            @error('image')
            {{ $message }}
            @enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
          <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
          <div class="invalid-feedback">
            @error('password')
            {{ $message }}
            @enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="confirm_password" class="form-label">Konfirmasi Password<span class="text-danger">*</span></label>
          <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" id="confirm_password" name="confirm_password">
          <div class="invalid-feedback">
            @error('confirm_password')
            {{ $message }}
            @enderror
          </div>
        </div>
        <button class="btn btn-tambah-buku" id="tambah_petugas" onclick="return confirm('Yakin ingin menambahkan petugas baru?')" type="submit" disabled>Tambah</button>
      </form>
    </div>
    <div class="col-md-9">
      @if(session('status'))
      <div class="alert alert-success" role="alert">
        {{session('status')}}
        <button type="button" class="btn-close btn-close-alert" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @elseif(session('err'))
      <div class="alert alert-danger" role="alert">
        {{session('err')}}
        <button type="button" class="btn-close btn-close-alert" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
      <!-- <form action="/dataPetugas" method="get">
        @csrf
        <input type="text" name="cari" class="form-control form-search" placeholder="Cari...">
        <button class="btn btn-search" type="Submit">Cari</button>
      </form>
      <a href="/refreshPetugas" class="btn btn-refresh">Refresh</a> -->
      <div class="petugas-table">
        <form action="hapusPetugas" method="post">
          @csrf
          <button type="submit" class="btn btn-hapus btn-daftar-buku" id="hapus_buku" onclick="return confirm('Yakin ingin menghapus petugas?')"><i class="fa fa-fw fa-minus-circle"></i> Hapus</button>
          <a href="/exportPetugasExcel" class="btn btn-daftar-buku btn-export" onclick="return confirm('Yakin ingin mengexport petugas?')"><i class="fa fa-fw fa-download"></i>Excel</a>
          <a href="/exportPetugasPdf" class="btn btn-daftar-buku btn-export" onclick="return confirm('Yakin ingin mengexport petugas?')"><i class="fa fa-fw fa-download"></i>PDF</a>
          <table class="table table-daftar-buku">
            <thead class="table-orange">
              <tr>
                <th scope="col"></th>
                <th scope="col">Nama Lengkap</th>
                <th scope="col">Email</th>
                <th scope="col">No. Telepon</th>
                <th scope="col">Role</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($petugas as $index => $p)
              <tr>
                <th scope="row">
                  <input type="checkbox" name="id[]" id="id" value="{{$p->id}}">
        </form>
        </th>
        <td>{{$p->name}}</td>
        <td>{{$p->email}}</td>
        <td>{{$p->phone}}</td>
        <td>{{$p->display_name}}</td>
        <td>
          <a href="detailPetugas/{{$p->id}}" class="badge bg-success">Detail</a>
        </td>
        </tr>
        @endforeach
        </tbody>
        </table>
      </div>
      @if(empty($petugas))
      <div class="alert alert-danger alert-not-found">
        Data petugas tidak ditemukan!
      </div>
      @endif
      {{$petugas->links()}}
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('.table-daftar-buku').DataTable();
  });
</script>
@endsection