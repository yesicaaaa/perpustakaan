@extends('layout.template')
@extends('layout.sidenav')
@section('css', 'petugas.css')
@section('sidenavcss', 'sidenav.css')
@section('js', 'data-anggota-petugas.js')
@section('title', 'Data Anggota | Fiore Library')
@section('content')
<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Data Anggota</li>
    </ol>
  </nav>
  @if(session('status'))
  <div class="alert alert-success fade show" role="alert">
    {{session('status')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  @error('image')
  <div class="alert alert-danger fade show" role="alert">
    {{$message}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  <div class="anggota-table">
  <a href="" class="btn btn-tambah-buku" data-bs-toggle="modal" data-bs-target="#tambahAnggotaModal"><i class="fa fa-fw fa-plus-circle"></i> Tambah</a>
    <table class="table table-buku-petugas">
      <thead class="table-orange">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nama</th>
          <th scope="col">Email</th>
          <th scope="col">Telepon</th>
          <th scope="col">Alamat</th>
          <th scope="col">Dibuat</th>
          <th scope="col">Diubah</th>
          <th scope="col">Status</th>
          <th scope="col" class="column-foto">Foto</th>
        </tr>
      </thead>
      <tbody>
        @foreach($anggota as $index => $a)
        <?php 
          $updated_at = ($a->updated_at) ? $a->updated_at : '-';
          $is_active = ($a->is_active == 1) ? 'Online' : 'Offline';
        ?>
        <td>{{$index + $anggota->firstItem()}}</td>
        <td>{{$a->name}}</td>
        <td>{{$a->email}}</td>
        <td>{{$a->phone}}</td>
        <td>{{$a->alamat}}</td>
        <td>{{$a->created_at}}</td>
        <td>{{$updated_at}}</td>
        <td class="is_active">{{$is_active}}</td>
        <td><img class="img-buku" src="/img/user_img/{{$a->image}}" alt=""></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  {{$anggota->links()}}
</div>

<!-- Modal Tambah Anggota-->
<div class="modal fade" id="tambahAnggotaModal" tabindex="-1" aria-labelledby="tambahAnggotaModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahAnggotaModalLabel">Tambah Anggota Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('register') }}" method="post" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="role" value="anggota">
          <div class="mb-3"> 
            <label for="name" class="form-label">Nama Lengkap<span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
            <div class="invalid-feedback">
              Nama Lengkap harus diisi!
            </div>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
            <div class="invalid-feedback">
              Email harus diisi!
            </div>
          </div>
          <div class="mb-3">
            <label for="phone" class="form-label">Telepon<span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
            <div class="invalid-feedback">
              Telepon harus diisi!
            </div>
          </div>
          <div class="mb-3">
            <label for="alamat" class="form-label">Alamat<span class="text-danger">*</span></label>
            <textarea name="alamat" id="alamat" cols="30" rows="10" class="@error('alamat') is-invalid @enderror">{{old('alamat')}}</textarea>
            <div class="invalid-feedback">
              Alamat harus diisi!
            </div>
          </div>
          <div class="mb-3">
            <label for="image" class="form-label">Foto<span class="text-danger">*</span></label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{ old('image') }}">
            <div class="invalid-feedback">
              Foto harus diisi!
            </div>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
            <div class="invalid-feedback">
              Password harus diisi!
            </div>
          </div>
          <div class="mb-3">
            <label for="confirm_password" class="form-label">Konfirmasi Password<span class="text-danger">*</span></label>
            <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" id="confirm_password" name="confirm_password">
            <div class="invalid-feedback">
              Konfirmasi Password harus diisi!
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

<script>
  $(document).ready(function() {
    $('.table-buku-petugas').DataTable();
  })
</script>
@endsection