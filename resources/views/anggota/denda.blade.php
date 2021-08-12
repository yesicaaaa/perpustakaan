@extends('layout.template')
@extends('layout.nav-anggota')
@section('title', 'Dashboard | Fiore Library')
@section('css', 'anggota.css')
@section('content')
<div class="main">
  <h5><a href="/dashboardAnggota/{{Auth::user()->id}}">Dashboard</a> / Denda</h5>
  <div class="divider-dipinjam"></div>
  <table class="table table-history">
    <thead>
      <tr>
        <th scope="col">Kode Peminjaman</th>
        <th scope="col">Pengembalian</th>
        <th scope="col">Terlambat</th>
        <th scope="col">Denda</th>
        <th scope="col">Petugas</th>
      </tr>
    </thead>
    <tbody>
      @foreach($denda as $d)
      <tr>
        <th scope="row">PMJ{{str_pad($d->id_peminjaman, 4, 0, STR_PAD_LEFT)}}</th>
        <td>{{$d->tgl_kembali}}</td>
        <td>{{$d->terlambat}} Hari</td>
        <td>{{$d->denda}}</td>
        <td>{{$d->name}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<script>
  $(document).ready(function() {
    $('.table-history').DataTable();
  })
</script>
@endsection