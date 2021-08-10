@extends('layout.template')
@extends('layout.nav-anggota')
@section('title', 'Dashboard | Fiore Library')
@section('css', 'anggota.css')
@section('content')
<div class="main">
  <h5><a href="/dashboardAnggota/{{Auth::user()->id}}">Dashboard</a> / Buku Dipinjam</h5>
  <div class="divider-dipinjam"></div>
  <table class="table table-history">
    <thead>
      <tr>
        <th scope="col">Kode</th>
        <th scope="col">Judul</th>
        <th scope="col">Qty</th>
        <th scope="col">Peminjaman</th>
      </tr>
    </thead>
    <tbody>
      @foreach($peminjaman as $p)
      <tr>
        <th scope="row">PMJ{{str_pad($p->id_peminjaman, 4, 0, STR_PAD_LEFT)}}</th>
        <td>{{$p->judul}}</td>
        <td>{{$p->qty}}</td>
        <td>{{$p->tgl_pinjam}}</td>
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