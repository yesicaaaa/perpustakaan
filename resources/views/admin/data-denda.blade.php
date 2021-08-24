@extends('layout.template')
@extends('layout.sidenav')
@section('css','admin.css')
@section('sidenavcss', 'sidenav.css')
@section('title', 'Laporan Peminjaman | Fiore Library')
@section('content')
<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-fw fa-clipboard"></i> Laporan Peminjaman</li>
    </ol>
  </nav>
  <div class="laporan-denda-table">
    <table class="table table-daftar-buku" id="table-daftar-buku">
      <thead class="table-orange">
        <tr>
          <th scope="col">Kode Petugas</th>
          <th scope="col">Nama</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        @foreach($denda as $d)
        <tr>
          <td>PTG{{str_pad($d->id_petugas, 4, 0, STR_PAD_LEFT)}}</td>
          <td>{{$d->name}}</td>
          <td>
            <a href="detailDataDenda/{{$d->id_petugas}}" class="badge bg-success">Detail</a>
          </td>
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