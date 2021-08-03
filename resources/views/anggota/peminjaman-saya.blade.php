@extends('layout.template')
@extends('layout.nav-anggota')
@section('title', 'Peminjaman Saya | Fiore Library')
@section('css', 'anggota.css')
@section('content')
<div class="main">
  @if(session('status'))
  <div class="alert alert-success fade show" role="alert">
    {{session('status')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  @error('perpanjang_pinjam')
  <div class="alert alert-danger fade show" role="alert">
    {{$message}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  <div class="row cari">
    <div class="col-md-3">
      <h5>Peminjaman Saya</h5>
      <div class="divider-buku"></div>
    </div>
    <div class="col-md-9">
      <p>Cari :<span>
          <input type="text" id="cari" name="cari">
        </span></p>
    </div>
  </div>
  <div class="row">
    @foreach($peminjamanSaya as $ps)
    <?php
    $hrs_kembali = strtotime($ps->tgl_hrs_kembali);
    $now = strtotime(date('Y-m-d'));
    $kembalikan = ($hrs_kembali <= $now) ? 'text-danger' : 'text-success';
    $perpanjang_pinjam = ($ps->perpanjang_pinjam != null) ? $ps->perpanjang_pinjam : '-';
    $perpanjang_disabled = ($kembalikan == 'text-danger') ? 'perpanjang-disabled' : 'perpanjang-able';
    ?>
    <div class="col-md-4">
      <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="/img/buku/{{$ps->foto}}" class="img-fluid rounded-start" alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h6 class="card-title">{{$ps->judul}}</h6>
              <p class="card-text">Peminjaman : <span>{{$ps->tgl_pinjam}}</span></p>
              <p class="card-text {{$kembalikan}}">Harus Kembali : <span>{{$ps->tgl_hrs_kembali}}</span></p>
              <p class="card-text">Perpanjangan Pinjam : <span>{{$perpanjang_pinjam}}</span> Hari</p>
              <a href="javascript:getData({{$ps->id_peminjaman}})" class="badge bg-success {{$perpanjang_disabled}} perpanjang-pinjam">Perpanjang Pinjam</a>
              <button class="btn btn-success perpanjang-pinjam2" disabled>Perpanjang Pinjam</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="perpanjanganModal" tabindex="-1" aria-labelledby="perpanjanganLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="perpanjanganLabel">Perpanjangan Peminjaman Buku</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/perpanjanganAnggota" method="post">
          <input type="hidden" name="_method" value="POST">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="id_peminjaman" id="id_peminjaman">
          <div class="mb-3 row">
            <label for="judul" class="col-sm-4 col-form-label">Judul Buku</label>
            <div class="col-sm-8">
              <input type="text" class="form-control form-control-sm" id="judul" name="judul" readonly>
            </div>
          </div>
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
              <input type="number" class="form-control form-control-sm" id="perpanjang_pinjam" name="perpanjang_pinjam" onkeypress="return event.charCode >= 49 && event.charCode <= 55" min="1" max="7">
              <div class="invalid-feedback">
                Data harus diisi!
              </div>
            </div>
          </div>
          <input type="hidden" name="id_anggota" value="{{Auth::user()->id}}">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary btn-simpan" onclick="return confirm('Yakin ingin perpanjang peminjaman?')">Simpan</button>
        <button class="btn btn-primary btn-simpan btn-simpan-tunggu" disabled>Tunggu...</button>
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
      type: 'post',
      dataType: 'json',
      url: '/getPerpanjanganAnggotaRow',
      data: {
        id: id
      },
      success: function(data) {
        $('#id_peminjaman').val(data.id_peminjaman),
          $('#judul').val(data.judul),
          $('#tgl_pinjam').val(data.tgl_pinjam),
          $('#tgl_hrs_kembali').val(data.tgl_hrs_kembali),
          $('#perpanjanganModal').modal('show')
      }
    })
  }

  $(document).ready(function() {
    $('.perpanjang-pinjam').hide();
    $('.perpanjang-pinjam2').hide();

    if ($('a').hasClass('perpanjang-disabled')) {
      $('.perpanjang-pinjam2').show();
    } else if($('a').hasClass('perpanjang-able')) {
      $('.perpanjang-pinjam').show();
    }

    $('.btn-simpan-tunggu').hide();
    $('#perpanjang_pinjam').on('keyup', function() {
      if ($(this).val() == '') {
        $(this).addClass('is-invalid');
      } else {
        $(this).removeClass('is-invalid').addClass('is-valid');
      }
    })
    $('.btn-simpan').on('click', function() {
      $(this).hide();
      $('.btn-simpan-tunggu').show();
    })
  })
</script>
@endsection