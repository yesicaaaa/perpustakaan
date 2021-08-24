@extends('layout.template')
@extends('layout.sidenav')
@section('css', 'admin.css')
@section('sidenavcss', 'sidenav.css')
@section('title', 'Detail Petugas | Fiore Library')
@section('content')
<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item" aria-current="page"><a href="/dataPetugas" class="prev"><i class="fa fa-fw fa-address-book"></i> Data Petugas</a></li>
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
  <a href="/dataPetugas" class="icon-back"><i class="fa fa-fw fa-arrow-circle-left"></i> Kembali</a>
  <div class="row detail-buku detail-petugas">
    <div class="col-md-3">
      <img src="/img/user_img/{{$petugas->image}}" alt="">
    </div>
    <div class="col-md-9">
      <h3>{{$petugas->name}}</h3>
      <h6>{{$petugas->display_name}}</h6>
      <table class="table table-bordered table-detail-buku">
        <tr>
          <th scope="col">Email</th>
          <td>{{$petugas->email}}</td>
        </tr>
        <tr>
          <th scope="col">No. Telepon</th>
          <td>{{$petugas->phone}}</td>
        </tr>
        <tr>
          <th scope="col">Alamat</th>
          <td>{{$petugas->alamat}}</td>
        </tr>
        <tr>
          <th scope="col">Status</th>
          <td>{{($petugas->is_active == 1) ? 'Online' : 'Offline'}}</td>
        </tr>
        <tr>
          <th scope="col">Tanggal Dibuat</th>
          <td>{{$petugas->created_at}}</td>
        </tr>
        <tr>
          <th scope="col">Tanggal Diubah</th>
          @if($petugas->updated_at)
          <td>{{$petugas->updated_at}}</td>
          @else
          <td>-</td>
          @endif
        </tr>
      </table>
    </div>
  </div>
</div>
@endsection