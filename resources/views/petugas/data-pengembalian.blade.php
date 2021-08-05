@extends('layout.template')
@extends('layout.sidenav')
@section('css', 'petugas.css')
@section('sidenavcss', 'sidenav.css')
@section('title', 'Data Pengembalian | Fiore Library')
@section('content')
<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Data Pengembalian</li>
    </ol>
  </nav>
  @if(session('err'))
  <div class="alert alert-danger" role="alert">
    {{session('err')}}
    <button type="button" class="btn-close btn-close-alert" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  @if(session('status'))
  <div class="alert alert-success" role="alert">
    {{session('status')}}
    <button type="button" class="btn-close btn-close-alert" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  <table class="table table-striped table-bordered data-buku data-pengembalian">
    <thead class="table-orange">
      <tr>
        <th>Kode</th>
        <th>Nama</th>
        <th>Judul</th>
        <th>QTY</th>
        <th>Peminjaman</th>
        <th>Perpanjangan</th>
        <th>Pengembalian</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($peminjaman as $p)
      <?php
      $perpanjangan = ($p->perpanjang_pinjam != null) ? $p->perpanjang_pinjam . ' Hari' : '-';
      ?>
      <tr>
        <td>PMJ{{str_pad($p->id_peminjaman, 4, 0, STR_PAD_LEFT)}}</td>
        <td>{{$p->name}}</td>
        <td>{{$p->judul}}</td>
        <td>{{$p->qty}}</td>
        <td>{{$p->tgl_pinjam}}</td>
        <td>{{$perpanjangan}}</td>
        <td>{{$p->tgl_hrs_kembali}}</td>
        <td>
          <a href="javascript:getData({{$p->id_peminjaman}})" class="badge bg-success">Pengembalian</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<!-- Modal -->
<div class="modal fade" id="Modalpengembalian" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="pengembalianLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pengembalianLabel">Pengembalian Buku</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/pengembalian/" method="post">
          <input type="hidden" name="_method" value="POST">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="id_peminjaman" id="id_peminjaman">
          <div class="row data-peminjaman">
            <div class="col-md-6">
              <div class="mb-3 row">
                <label for="name" class="col-sm-4 col-form-label">Nama</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control form-control-sm" id="name" name="name" readonly>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="judul" class="col-sm-4 col-form-label">Judul</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control form-control-sm" id="judul" name="judul" readonly>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="qty" class="col-sm-4 col-form-label">QTY</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control form-control-sm" id="qty" name="qty" readonly>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3 row">
                <label for="peminjaman" class="col-sm-4 col-form-label">Peminjaman</label>
                <div class="col-sm-8">
                  <input type="date" class="form-control form-control-sm tgl-pinjam" id="tgl_pinjam" name="tgl_pinjam" readonly>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="perpanjangan" class="col-sm-4 col-form-label">Perpanjangan</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control form-control-sm" id="perpanjang_pinjam" name="perpanjang_pinjam" readonly>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="pengembalian" class="col-sm-4 col-form-label">Harus Kembali</label>
                <div class="col-sm-8">
                  <input type="date" class="form-control form-control-sm hrs-kembali" id="tgl_hrs_kembali" name="tgl_hrs_kembali" readonly>
                </div>
              </div>
            </div>
          </div>
          <div class="form-pengembalian">
            <div class="mb-3 row mt-3">
              <label for="tgl_kembali" class="col-sm-4 col-form-label">Tanggal Kembali</label>
              <div class="col-sm-8">
                <input type="date" class="form-control form-control-sm" id="tgl_kembali" name="tgl_kembali" value="{{ date('Y-m-d') }}" readonly>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="terlambat" class="col-sm-4 col-form-label">Terlambat(hari)</label>
              <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="terlambat" name="terlambat" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="denda" class="col-sm-4 col-form-label">Denda</label>
              <div class="col-sm-8">
                <input type="text" class="form-control form-control-sm" id="denda" readonly>
                <small>*Denda 3000/hari</small>
              </div>
            </div>
            <input type="hidden" id="dendaHidden" name="denda">
            <input type="hidden" name="id_petugas" value="{{Auth::user()->id}}">
            <input type="hidden" name="id_buku" id="id_buku">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btn-tambah-buku" onclick="return confirm('Yakin ingin mengembalikan buku?')">Simpan</button>
        </form>
      </div>
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
      url: '/getPeminjamanPengembalianRow/',
      data: {
        id: id
      },
      success: function(data) {
        $('#id_peminjaman').val(data.id_peminjaman);
        $('#name').val(data.name),
        $('#judul').val(data.judul),
          $('#qty').val(data.qty),
          $('#tgl_pinjam').val(data.tgl_pinjam),
          $('#perpanjang_pinjam').val(data.perpanjang_pinjam + ' Hari'),
          $('#tgl_hrs_kembali').val(data.tgl_hrs_kembali),
          $('#id_buku').val(data.id_buku),
          $('#Modalpengembalian').modal('show')
        }
      });
    }
    
    $(document).ready(function() {
      $('.data-pengembalian').dataTable();
      // let hrs_kembali = new date($('.hrs-kembali').val());
      // let hrs_kembali2 = hrs_kembali / 86400000;
      // let tgl_kembali = new date($('.tgl-kembali').val());
      // let tgl_kembali2 = tgl_kembali / 86400000;
    
      // let terlambat = hrs_kembali - tgl_kembali2;

    $('#terlambat, #denda').on('keyup', function() {
      var terlambat = $('#terlambat').val();
      var harga = 3000;

      var total = parseInt(terlambat) * harga;
      $('#denda').val('Rp' + numberWithCommas(total));
      $('#dendaHidden').val(total);
    });

    function numberWithCommas(x) {
      return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
  })
</script>
@endsection