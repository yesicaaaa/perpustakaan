@extends('layout.template')
@extends('layout.sidenav')
@section('css', 'admin.css')
@section('sidenavcss', 'sidenav.css')
@section('title', 'Detail Buku | Fiore Library')
@section('content')
<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item" aria-current="page"><a href="daftarBuku" class="prev">Daftar Buku</a></li>
      <li class="breadcrumb-item active" aria-current="page">Detail</li>
    </ol>
  </nav>
  <a href="/daftarBuku" class="icon-back"><i class="fa fa-fw fa-arrow-circle-left"></i> Kembali</a>
  <div class="row detail-buku">
    <div class="col-md-3">
      <img src="/img/buku/{{$buku->foto}}" alt="">
    </div>
    <div class="col-md-9">
      <h3>{{$buku->judul}}</h3>
      <h6>{{$buku->genre}}</h6>
      <table class="table table-bordered table-detail-buku">
        <tr>
          <th scope="col">Pengarang</th>
          <td>{{$buku->pengarang}}</td>
        </tr>
        <tr>
          <th scope="col">Penerbit</th>
          <td>{{$buku->penerbit}}</td>
        </tr>
        <tr>
          <th scope="col">Tahun Terbit</th>
          <td>{{$buku->tahun_terbit}}</td>
        </tr>
        <tr>
          <th scope="col">Bahasa</th>
          <td>{{$buku->bahasa}}</td>
        </tr>
        <tr>
          <th scope="col">Jumlah Halaman</th>
          <td>{{$buku->jml_halaman}}</td>
        </tr>
        <tr>
          <th scope="col">Stok</th>
          <td>{{$buku->stok}}</td>
        </tr>
      </table>
      <a href="javascript:getData({{$buku->id_buku}})" class="btn btn-daftar-buku btn-success btn-edit-buku"><i class="fa fa-fw fa-edit"></i> Edit</a>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editBuku" tabindex="-1" aria-labelledby="editBukuLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editBukuLabel">Edit Data Buku</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="id_buku" value="{{$buku->id_buku}}">
          <div class="mb-3 row">
            <label for="editJudul" class="col-sm-4 col-form-label">Judul<span class="text-danger">*</span></label>
            <div class="col-sm-8">
              <input type="text" class="form-control form-control-sm" id="editJudul" name="judul">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="editPengarang" class="col-sm-4 col-form-label">Pengarang<span class="text-danger">*</span></label>
            <div class="col-sm-8">
              <input type="text" class="form-control form-control-sm" id="editPengarang" name="pengarang">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="editPenerbit" class="col-sm-4 col-form-label">Penerbit<span class="text-danger">*</span></label>
            <div class="col-sm-8">
              <input type="text" class="form-control form-control-sm" id="editPenerbit" name="penerbit">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="editTahun_terbit" class="col-sm-4 col-form-label">Tahun Terbit<span class="text-danger">*</span></label>
            <div class="col-sm-8">
              <input type="text" class="form-control form-control-sm" id="editTahun_terbit" name="tahun_terbit" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="editFoto" class="col-sm-4 col-form-label">Foto<span class="text-danger">*</span></label>
            <div class="col-sm-8">
              <input type="file" class="form-control form-control-sm" id="editFoto" name="foto">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="editBahasa" class="col-sm-4 col-form-label">Bahasa<span class="text-danger">*</span></label>
            <div class="col-sm-8">
              <input type="text" class="form-control form-control-sm" id="editBahasa" name="bahasa">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="editGenre" class="col-sm-4 col-form-label">Genre<span class="text-danger">*</span></label>
            <div class="col-sm-8">
              <input class="form-control form-control-sm" list="datalistOptions" id="editGenre">
              <datalist id="datalistOptions">
                <option value="Drama">
                <option value="Action">
                <option value="Comedy">
                <option value="Horror">
                <option value="Romance">
                <option value="Fantasy">
                <option value="Adventure">
                <option value="Thiller">
                <option value="Sci-Fi">
                <option value="Mistery">
                <option value="Documenter">
                <option value="Biografi">
              </datalist>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="editJml_halaman" class="col-sm-4 col-form-label">Jumlah Halaman<span class="text-danger">*</span></label>
            <div class="col-sm-8">
              <input type="text" class="form-control form-control-sm" id="editJml_halaman" name="jml_halaman">
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="mb-3">
                <label for="editStok" class="form-label">Stok</label>
                <input type="text" class="form-control form-control-sm" id="editStok">
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-3">
                <label for="tambah_stok" class="form-label">Tambah Stok</label>
                <input type="number" class="form-control form-control-sm" name="tambah_stok" id="tambah_stok" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-3">
                <label for="kurangi_stok" class="form-label">Kurangi Stok</label>
                <input type="number" class="form-control form-control-sm" name="kurangi_stok" id="kurangi_stok" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary btn-edit">Simpan</button>
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
      type: 'post',
      dataType: 'json',
      url: '/getBukuRow/',
      data: {
        id: id
      },
      success: function(data) {
        $('#editJudul').val(data.judul),
          $('#editPengarang').val(data.pengarang),
          $('#editPenerbit').val(data.penerbit),
          $('#editTahun_terbit').val(data.tahun_terbit),
          // $('#editFoto').val(data.foto),
          $('#editBahasa').val(data.bahasa),
          $('#editGenre').val(data.genre),
          $('#editJml_halaman').val(data.jml_halaman),
          $('#editStok').val(data.stok),
          $('#editBuku').modal('show')
      }
    });
  }
</script>
@endsection