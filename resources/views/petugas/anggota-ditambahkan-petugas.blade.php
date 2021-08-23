@extends('layout.template')
@extends('layout.sidenav')
@section('css','petugas.css')
@section('sidenavcss', 'sidenav.css')
@section('title', 'Anggota Ditambahkan Petugas | Fiore Library')
@section('content')
<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item" aria-current="page"><a href="/dashboardPetugas" class="prev"><i class="fa fa-fw fa-home"></i> Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Anggota Ditambahkan</li>
    </ol>
  </nav>
  <div class="laporan-peminjaman-table">
    <a href="/exportAnggotaDitambahkanExcel" class="btn btn-daftar-buku btn-export" onclick="return confirm('Yakin ingin mengexport laporan anggota ditambahkan?')"><i class="fa fa-fw fa-download"></i>Excel</a>
    <a href="/exportAnggotaDitambahkanPdf" class="btn btn-daftar-buku btn-export" onclick="return confirm('Yakin ingin mengexport laporan anggota ditambahkan?')"><i class="fa fa-fw fa-download"></i>PDF</a>
    <table class="table table-daftar-buku" id="table-daftar-buku">
      <thead class="table-orange">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nama</th>
          <th scope="col">Email</th>
          <th scope="col">Created at</th>
          <th scope="col" class="column-foto">Foto</th>
        </tr>
      </thead>
      <tbody>
        @foreach($anggota as $a)
        <tr>
          <td>{{$loop->iteration}}</td>
          <td>{{$a->name}}</td>
          <td>{{$a->email}}</td>
          <td>{{$a->created_at}}</td>
          <td><img class="img-buku" src="/img/user_img/{{$a->image}}" alt=""></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#table-daftar-buku').DataTable();
  });
</script>
@endsection