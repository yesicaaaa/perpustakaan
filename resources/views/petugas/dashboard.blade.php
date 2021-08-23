@extends('layout.template')
@extends('layout.sidenav')
@section('css', 'petugas.css')
@section('sidenavcss', 'sidenav.css')
@section('title', 'Dashboard | Fiore Library')
@section('content')
<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-fw fa-home"></i> Dashboard</li>
    </ol>
  </nav>
  <div class="row daftar-jumlah">
    <div class="col-md-3">
      <div class="jml-buku">
        <div class="row">
          <div class="col-md-8">
            <h1>{{($buku['total'] != null) ? $buku['total'] . '+' : '0'}}</h1>
            <p>Buku Ditambahkan</p>
          </div>
          <div class="col-md-4">
            <i class="fa fa-fw fa-book"></i>
          </div>
        </div>
        <a href="/bukuDitambahkanPetugas">Lihat <i class="fa fa-fw fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-md-3">
      <div class="jml-user">
        <div class="row">
          <div class="col-md-8">
            <h1>{{($anggota['jml_anggota'] != null) ? $anggota['jml_anggota'] . '+' : '0'}}</h1>
            <p>Anggota Ditambahkan</p>
          </div>
          <div class="col-md-4">
            <i class="fa fa-fw fa-user-plus"></i>
          </div>
        </div>
        <a href="/AnggotaDitambahkanPetugas">Lihat <i class="fa fa-fw fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-md-3">
      <div class="jml-peminjaman">
        <div class="row">
          <div class="col-md-8">
            <h1>{{($peminjaman != null) ? $peminjaman . '+' : '0'}}</h1>
            <p>Peminjaman</p>
          </div>
          <div class="col-md-4">
            <i class="fa fa-fw fa-inbox"></i>
          </div>
        </div>
        <a href="/dataPeminjaman">Lihat <i class="fa fa-fw fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-md-3">
      <div class="jml-pengembalian">
        <div class="row">
          <div class="col-md-8">
            <h1>{{($pengembalian != null) ? $pengembalian . '+' : '0'}}</h1>
            <p>Pengembalian</p>
          </div>
          <div class="col-md-4">
            <i class="fa fa-fw fa-inbox"></i>
          </div>
        </div>
        <a href="/historyPengembalian">Lihat <i class="fa fa-fw fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>
  <div class="row week-report">
    <div class="col-md-6">
      <img src="/img/vault.svg" alt="">
    </div>
    <div class="col-md-6 report">
      <h4>Perolehan Denda<span> / hari</span></h4>
      @if($reportWeek != null)
      <h1>Rp{{number_format($reportWeek['denda'], 0, ',', '.')}}</h1>
      <h5>{{$reportWeek['tgl_kembali']}}</h5>
      @else
      <h1>Rp0</h1>
      <h5>-</h5>
      @endif
    </div>
  </div>
  <div class="row">
    <div class="col-md-2 grf-peminjaman">
      <canvas id="peminjamanGrafik" width="800" height="250"></canvas>
    </div>
    <div class="col-md-4 grf-peminjaman-img">
      <img src="/img/grafik_up.svg" alt="">
    </div>
  </div>
  <?php
  //grafik peminjaman
  $tgl_peminjaman = null;
  $total_peminjaman = null;
  foreach ($peminjamanGrafik as $pg) {
    $tgl_p = $pg['tgl_pinjam'];
    $tgl_peminjaman .= "'$tgl_p'" . ", ";
    $total_p = $pg['total'];
    $total_peminjaman .= "'$total_p'" . ", ";
  }
  ?>
</div>

<script>
  $(document).ready(function() {
    var ctx_peminjaman = document.getElementById('peminjamanGrafik').getContext('2d');
    var chart_peminjaman = new Chart(ctx_peminjaman, {
      type: 'line',
      data: {
        labels: [<?= $tgl_peminjaman ?>],
        datasets: [{
          label: 'Data Peminjaman Terbaru',
          borderColor: "rgb(0, 166, 90)",
          data: [<?= $total_peminjaman ?>]
        }]
      },
      options: {
        responsive: false
      }
    })

  })
</script>
@endsection