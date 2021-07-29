@extends('layout.template')
@extends('layout.sidenav')
@section('css', 'petugas.css')
@section('sidenavcss', 'sidenav.css')
@section('title', 'Detail Peminjaman | Fiore Library')
@section('content')
<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item breadcrumb-link" aria-current="page"><a href="/dataPeminjaman">Data Peminjaman</a></li>
      <li class="breadcrumb-item active" aria-current="page">Detail Peminjaman</li>
    </ol>
  </nav>
  @if(session('status'))
  <div class="alert alert-success" role="alert">
    {{session('status')}}
    <button type="button" class="btn-close btn-close-alert" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  @error('perpanjang_pinjam')
  <div class="alert alert-danger" role="alert">
    Perpanjangan tidak boleh lebih dari 7 hari!
    <button type="button" class="btn-close btn-close-alert" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  <div class="data-peminjam">
    <div class="row">
      <div class="col-md-2">
        <img src="/img/user_img/{{$anggota->image}}" alt="">
      </div>
      <div class="col-md-6">
        <table class="table table-bordered table-detail-peminjaman">
          <tr>
            <th scope="col">Nama Lengkap</th>
            <td>{{$anggota->name}}</td>
          </tr>
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
        </table>
      </div>
    </div>
  </div>
  <table class="table table-striped table-bordered data-peminjaman">
    <thead>
      <tr>
        <th>Kode</th>
        <th>Judul</th>
        <th>Qty</th>
        <th>Peminjaman</th>
        <th>Perpanjangan</th>
        <th>Harus Kembali</th>
        <!-- <th>Petugas</th> -->
        <th>Status</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($peminjaman as $p)
      <?php
      $perpanjangan = ($p->perpanjang_pinjam != null) ? $p->perpanjang_pinjam . ' Hari' : '-';
      $btnPerpanjangan = ($perpanjangan != null) ? 'disabled' : '';
      ?>
      <tr>
        <td>PMJ{{str_pad($p->id_peminjaman, 4, 0, STR_PAD_LEFT)}}</td>
        <td>{{$p->judul}}</td>
        <td>{{$p->qty}}</td>
        <td>{{$p->tgl_pinjam}}</td>
        <td>{{$perpanjangan}}</td>
        <td>{{$p->tgl_hrs_kembali}}</td>
        <td>{{$p->status}}</td>
        <td>
          <button href="javascript:getData({{$p->id_peminjaman}})" class="btn btn-success {{$btnPerpanjangan}}" id="btnPerpanjangan">Perpanjangan</button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<!-- Modal -->
<div class="modal fade" id="perpanjangan" tabindex="-1" aria-labelledby="perpanjanganLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="perpanjanganLabel">Perpanjangan Peminjaman Buku</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/perpanjangan" method="post">
          <input type="hidden" name="_method" value="POST">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="id_petugas" value="{{ Auth::user()->id }}">
          <input type="hidden" name="id_peminjaman" id="id_peminjamanPost">
          <input type="hidden" name="id_anggota" value="{{$anggota->id}}">
          <div class="mb-3 row">
            <label for="tgl_pinjam" class="col-sm-4 col-form-label">Tanggal Peminjaman</label>
            <div class="col-sm-8">
              <input type="date" class="form-control form-control-sm" id="tgl_pinjam" name="tgl_pinjam" readonly>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="tgl_hrs_kembali" class="col-sm-4 col-form-label">Tanggal Harus Kembali</label>
            <div class="col-sm-8">
              <input type="date" class="form-control form-control-sm" id="tgl_hrs_kembali" name="tgl_hrs_kembali" readonly>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="perpanjang_pinjam" class="col-sm-4 col-form-label">Perpanjangan Pinjam(hari)<span class="text-danger">*</span></label>
            <div class="col-sm-8">
              <input type="number" class="form-control form-control-sm" id="perpanjang_pinjam" name="perpanjang_pinjam" onkeypress="return event.charCode >= 49 && event.charCode <= 55">
              <div class="invalid-feedback">
                Data harus diisi!
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary btn-simpan" onclick="return confirm('Yakin ingin perpanjang peminjaman?')">Simpan</button>
        <button class="btn btn-primary btn-simpan-tunggu" disabled>Tunggu...</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  function getData(id) {
    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: '/getPeminjamanRow/',
      data: {
        id: id
      },
      success: function(data) {
        $('#id_peminjamanPost').val(data.id_peminjaman),
          $('#tgl_pinjam').val(data.tgl_pinjam),
          $('#tgl_hrs_kembali').val(data.tgl_hrs_kembali)
        $('#perpanjangan').modal('show')
      }
    })
  }
  $(document).ready(function() {
    $('.data-peminjaman').dataTable();

    $('.btn-simpan-tunggu').hide();
    $('#perpanjang_pinjam').on('keyup', function() {
      if ($('#perpanjang_pinjam').val() == '') {
        $(this).addClass('is-invalid');
      } else {
        $(this).removeClass('is-invalid').addClass('is-valid');
      }
    })

    $('.btn-simpan').on('click', function() {
      $(this).hide();
      $('.btn-simpan-tunggu').show();
    });

    if($('#btnPerpanjangan').hasClass('disabled')) {
      $(this).prop('disabled');
    }
  })
</script>
@endsection