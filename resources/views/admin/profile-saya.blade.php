@extends('layout.template')
@extends('layout.sidenav')
@section('css', 'admin.css')
@section('sidenavcss', 'sidenav.css')
@section('title', 'Profile Saya | Fiore Library')
@section('content')
<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Profile Saya</li>
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
  <div class="row detail-buku detail-petugas">
    <div class="col-md-3">
      <img src="/img/user_img/{{Auth::user()->image}}" alt="">
    </div>
    <div class="col-md-9">
      <h3>{{Auth::user()->name}}</h3>
      <h6>Administrator</h6>
      <table class="table table-bordered table-detail-buku">
        <tr>
          <th scope="col">Email</th>
          <td>{{Auth::user()->email}}</td>
        </tr>
        <tr>
          <th scope="col">No. Telepon</th>
          <td>{{Auth::user()->phone}}</td>
        </tr>
        <tr>
          <th scope="col">Alamat</th>
          <td>{{Auth::user()->alamat}}</td>
        </tr>
        <tr>
          <th scope="col">Status</th>
          @if(Auth::user()->is_active == 1)
          <td>Online</td>
          @else
          <td>Offline</td>
          @endif
        </tr>
        <tr>
          <th scope="col">Tanggal Dibuat</th>
          <td>{{Auth::user()->created_at}}</td>
        </tr>
      </table>
    </div>
  </div>
</div>
@endsection