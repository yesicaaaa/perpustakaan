@extends('layout.template')
@extends('layout.nav-anggota')
@section('title', 'Profile Saya | Fiore Library')
@section('css', 'anggota.css')
@section('content')
<div class="main">
  @if(session('status'))
  <div class="alert alert-success fade show" role="alert">
    {{session('status')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  <h5>Profile Saya</h5>
  <div class="divider-history"></div>
  <div class="row">
    <div class="col-md-8 profile-saya">
      <h5>Ubah Profile Saya</h5>
      <img src="/img/user_img/{{Auth::user()->image}}" alt="">
      <form action="/ubahProfileSaya" method="post" id="form_ubah">
        @csrf
        <input type="hidden" name="id" value="{{Auth::user()->id}}">
        <div class="mb-3 row mt-3 ml-35">
          <label for="name" class="col-sm-4 col-form-label">Nama Lengkap</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="name" name="name" value="{{Auth::user()->name}}" disabled>
          </div>
        </div>
        <div class="mb-3 row mt-3 ml-35">
          <label for="email" class="col-sm-4 col-form-label">Email</label>
          <div class="col-sm-8">
            <input type="email" class="form-control" id="email" name="email" value="{{Auth::user()->email}}" disabled>
          </div>
        </div>
        <div class="mb-3 row mt-3 ml-35">
          <label for="phone" class="col-sm-4 col-form-label">No. Telepon<span class="text-danger">*</span></label>
          <div class="col-sm-8">
            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{Auth::user()->phone}}" onclick="return event.charCode >= 48 && event.charCode <= 57">
            <div class="invalid-feedback">
              @error('phone')
              {{$message}}
              @enderror
            </div>
          </div>
        </div>
        <div class="mb-3 row mt-3 ml-35">
          <label for="alamat" class="col-sm-4 col-form-label">Alamat<span class="text-danger">*</span></label>
          <div class="col-sm-8">
            <textarea type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat">{{Auth::user()->alamat}}</textarea>
            <div class="invalid-feedback">
              @error('alamat')
              {{$message}}
              @enderror
            </div>
          </div>
        </div>
        <div class="mb-3 row mt-3 ml-35">
          <label for="created_at" class="col-sm-4 col-form-label">Dibuat Tanggal</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="created_at" name="created_at" value="{{Auth::user()->created_at}}" disabled>
          </div>
        </div>
        <div class="mb-3 row mt-3 ml-35">
          <label for="updated_at" class="col-sm-4 col-form-label">Diubah Tanggal</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="updated_at" name="updated_at" value="{{Auth::user()->updated_at}}" disabled>
          </div>
        </div>
        <button type="submit" class="btn btn-save" onclick="return confirm('Yakin ingin mengubah profile?')"><i class="fa fa-fw fa-save"></i> Simpan</button>
        <button type="button" class="btn btn-secondary" id="reset_ubah"><i class="fa fa-fw fa-cut"></i> Setel Ulang</button>
      </form>
    </div>
  </div>
</div>
@endsection

<script>
  $(document).ready(function() {
    $('#reset_ubah').on('click', function() {
      $('#form_ubah').reset();
    })
  })
</script>