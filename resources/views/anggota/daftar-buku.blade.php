@extends('layout.template')
@extends('layout.nav-anggota')
@section('title', 'Daftar Buku | Fiore Library')
@section('css', 'anggota.css')
@section('content')
<div class="main">
  <div class="row cari">
    <div class="col-md-3">
      <h3>Daftar Buku</h3>
      <div class="divider-buku"></div>
    </div>
    <div class="col-md-9">
      <p>Cari :<span>
          <input type="text" id="cari" name="cari">
        </span></p>
    </div>
  </div>
  <div class="row daftar-buku">

  </div>
</div>

<script>
  $(document).ready(function() {
    load_data();

    function load_data(cari) {
      $.ajax({
        method: 'get',
        dataType: 'json',
        url: '/cariBukuAnggota/',
        data: {
          cari: cari
        },
        success: function(data) {
          $('.daftar-buku').html(data);
        }
      });
    }

    $('#cari').on('keyup', function() {
      var cari = $('#cari').val();
      load_data(cari);
    });
  })
</script>
@endsection