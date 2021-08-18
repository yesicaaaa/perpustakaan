@extends('layout.template')
@extends('layout.sidenav')
@section('title', 'Dashboard | Fiore Library')
@section('css', 'admin.css')
@section('sidenavcss', 'sidenav.css')
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
            <h1>{{$buku}}+</h1>
            <p>Buku</p>
          </div>
          <div class="col-md-4">
            <i class="fa fa-fw fa-book"></i>
          </div>
        </div>
        <a href="/daftarBuku">Lihat <i class="fa fa-fw fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-md-3">
      <div class="jml-user">
        <div class="row">
          <div class="col-md-8">
            <h1>{{$anggota['jml_anggota']}}+</h1>
            <p>Anggota</p>
          </div>
          <div class="col-md-4">
            <i class="fa fa-fw fa-user-plus"></i>
          </div>
        </div>
        <a href="/dataAnggota">Lihat <i class="fa fa-fw fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-md-3">
      <div class="jml-peminjaman">
        <div class="row">
          <div class="col-md-8">
            <h1>{{$peminjaman}}+</h1>
            <p>Peminjaman</p>
          </div>
          <div class="col-md-4">
            <i class="fa fa-fw fa-inbox"></i>
          </div>
        </div>
        <a href="/laporanPeminjaman">Lihat <i class="fa fa-fw fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-md-3">
      <div class="jml-pengembalian">
        <div class="row">
          <div class="col-md-8">
            <h1>{{$pengembalian}}+</h1>
            <p>Pengembalian</p>
          </div>
          <div class="col-md-4">
            <i class="fa fa-fw fa-inbox"></i>
          </div>
        </div>
        <a href="/laporanPengembalian">Lihat <i class="fa fa-fw fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>
  <div class="grf-peminjaman">
    <canvas id="peminjamanGrafik" width="800" height="250"></canvas>
  </div>
  <div class="row">
    <div class="col-md-4 date-desc">
      <h3>{{strtoupper($date)}}</h3>
      <h4>{{date('Y')}}, {{strtoupper($day)}}</h4>
      <?php date_default_timezone_set('Asia/Jakarta') ?>
      <h5>{{date('H:i')}}</h5>
    </div>
    <div class="col-md-8 clock-container">
      <div class="point">.</div>
      <div id="hour"></div>
      <div id="minute"></div>
      <div id="second"></div>
    </div>
  </div>
  <div class="row grafik-info">
    <div class="col-md-4">
      <canvas id="bukuGrafik" width="350" height="200"></canvas>
      <p>Buku Yang Paling Banyak Dipinjam</p>
    </div>
    <div class="col-md-4">
      <canvas id="userGrafik" width="350" height="200"></canvas>
      <p>Total Pengguna</p>
    </div>
    <div class="col-md-4">
      <canvas id="pengembalianGrafik" width="350" height="200"></canvas>
      <p>Data Pengembalian 3 Hari Terakhir</p>
    </div>
  </div>
  <?php
  //data peminjaman
  $tgl_peminjaman = null;
  $total_peminjaman = null;
  foreach ($peminjamanGrafik as $pg) {
    $tgl_p = $pg['tgl_pinjam'];
    $tgl_peminjaman .= "'$tgl_p'" . ', ';
    $total_p = $pg['total'];
    $total_peminjaman .= "'$total_p'" . ', ';
  }

  //data peminjaman buku terbanyak
  $judul_buku = null;
  $total_peminjaman_buku = null;
  foreach ($mostbook as $mb) {
    $judul = str_replace('\'', '', $mb['judul']);
    $judul_b = $judul;
    $judul_buku .= "'$judul_b'" . ', ';
    $total_peminjaman_b = $mb['total'];
    $total_peminjaman_buku .= "'$total_peminjaman_b'" . ', ';
  }

  //data user
  $role_name = null;
  $total_user = null;
  foreach ($userGrafik as $ug) {
    $role_n = $ug['name'];
    $role_name .= "'$role_n'" . ', ';
    $total_u = $ug['total'];
    $total_user .= "'$total_u'" . ', ';
  }

  //data pengembalian
  $tgl_kembali = null;
  $total_pengembalian = null;
  foreach ($pengembalianGrafik as $pg) {
    $tgl_k = $pg['tgl_kembali'];
    $tgl_kembali .= "'$tgl_k'" . ', ';
    $total_p = $pg['total'];
    $total_pengembalian .= "'$total_p'" . ', ';
  }
  ?>
</div>

<script>
  setInterval(() => {
    d = new Date();
    hr = d.getHours();
    min = d.getMinutes();
    sec = d.getSeconds();
    hr_rotation = 30 * hr + min / 2;
    min_rotation = 6 * min;
    sec_rotation = 6 * sec;

    hour.style.transform = `rotate(${hr_rotation}deg)`;
    minute.style.transform = `rotate(${min_rotation}deg)`;
    second.style.transform = `rotate(${sec_rotation}deg)`;
  });

  //grafik peminjaman/7 hari
  var ctx_peminjaman = document.getElementById('peminjamanGrafik').getContext('2d');
  var chart_peminjaman = new Chart(ctx_peminjaman, {
    type: 'line',
    data: {
      labels: [<?= $tgl_peminjaman ?>],
      datasets: [{
        label: 'Total Peminjaman 7 Hari Terakhir',
        borderColor: 'rgb(36, 62, 75)',
        data: [<?= $total_peminjaman ?>]
      }]
    },
    options: {
      responsive: false
    }
  });

  //grafik peminjaman buku terbanyak
  var ctx_mostbook = document.getElementById('bukuGrafik').getContext('2d');
  var chart_mostbook = new Chart(ctx_mostbook, {
    type: 'doughnut',
    data: {
      labels: [<?= $judul_buku ?>],
      datasets: [{
        backgroundColor: [
          'rgb(221, 76, 57)',
          'rgb(0, 192, 237)',
          'rgb(0, 166, 90)'
        ],
        data: [<?= $total_peminjaman_buku ?>]
      }]
    },
    options: {
      responsive: false
    }
  });

  //grafik total user
  var ctx_user = document.getElementById('userGrafik').getContext('2d');
  var chart_user = new Chart(ctx_user, {
    type: 'polarArea',
    data: {
      labels: [<?= $role_name ?>],
      datasets: [{
        backgroundColor: [
          'rgb(221, 76, 57)',
          'rgb(0, 192, 237)',
          'rgb(0, 166, 90)'
        ],
        data: [<?= $total_user ?>]
      }]
    },
    options: {
      responsive: false
    }
  });

  //grafik data pengembalian
  var ctx_pengembalian = document.getElementById('pengembalianGrafik').getContext('2d');
  var chart_pengembalian = new Chart(ctx_pengembalian, {
    type: 'doughnut',
    data: {
      labels: [<?= $tgl_kembali ?>],
      datasets: [{
        backgroundColor: [
          'rgb(221, 76, 57)',
          'rgb(0, 192, 237)',
          'rgb(0, 166, 90)'
        ],
        data: [<?= $total_pengembalian ?>]
      }]
    },
    options: {
      responsive: false
    }
  })
</script>
@endsection