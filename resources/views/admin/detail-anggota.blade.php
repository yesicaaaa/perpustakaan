@extends('layout.template')
@extends('layout.sidenav')
@section('css', 'admin.css')
@section('sidenavcss', 'sidenav.css')
@section('title', 'Detail Anggota | Fiore Library')
@section('content')
<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item" aria-current="page"><a href="/dataAnggota" class="prev"><i class="fa fa-fw fa-address-book"></i> Data Anggota</a></li>
      <li class="breadcrumb-item active" aria-current="page">Detail</li>
    </ol>
  </nav>
  @if(session('status'))
  <div class="alert alert-success" role="alert">
    {{session('status')}}
    <button type="button" class="btn-close btn-close-alert" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  @error('image')
  <div class="alert alert-danger" role="alert">
    {{$message}}
    <button type="button" class="btn-close btn-close-alert" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  <a href="/dataAnggota" class="icon-back"><i class="fa fa-fw fa-arrow-circle-left"></i> Kembali</a>
  <div class="row detail-buku detail-petugas">
    <div class="col-md-3">
      <img src="/img/user_img/{{$anggota->image}}" alt="">
    </div>
    <div class="col-md-9">
      <h3>{{$anggota->name}}</h3>
      <h6>{{$anggota->display_name}}</h6>
      <table class="table table-bordered table-detail-buku">
        <tr>
          <th scope="col">Email</th>
          <td>{{$anggota->email}}</td>
        </tr>
        <tr>
          <th scope="col">No. Telepon</th>
          <td>{{$anggota->phone}}</td>
        </tr>
        <tr>
          <th scope="col">Alamat</th>
          <td>{{$anggota->alamat}}</td>
        </tr>
        <tr>
          <th scope="col">Status</th>
          @if($anggota->is_active == 1)
          <td>Online</td>
          @else
          <td>Offline</td>
          @endif
        </tr>
        <tr>
          <th scope="col">Tanggal Dibuat</th>
          <td>{{$anggota->created_at}}</td>
        </tr>
        <tr>
          <th scope="col">Tanggal Diubah</th>
          @if($anggota->updated_at)
          <td>{{$anggota->updated_at}}</td>
          @else
          <td>-</td>
          @endif
        </tr>
      </table>
    </div>
  </div>
</div>
@endsection