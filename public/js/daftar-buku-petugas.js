$(document).ready(function() {
  $('#btn-disabled').hide();
  $('#judul').on('keyup', function() {
    if($(this).val() == '') {
      $(this).addClass('is-invalid');
    }else{
      $(this).removeClass('is-invalid').addClass('is-valid');
    }
  })
  $('#judul').on('keypress', function() {
    $('#pengarang').focus();
  })
  $('#pengarang').on('keyup', function() {
    if($(this).val() == '') {
      $(this).addClass('is-invalid');
    }else{
      $(this).removeClass('is-invalid').addClass('is-valid');
    }
  })
  $('#pengarang').on('keypress', function() {
    $('#penerbit').focus();
  })
  $('#penerbit').on('keyup', function() {
    if($(this).val() == '') {
      $(this).addClass('is-invalid');
    }else{
      $(this).removeClass('is-invalid').addClass('is-valid');
    }
  })
  $('#penerbit').on('keypress', function() {
    $('#tahun_terbit').focus();
  })
  $('#tahun_terbit').on('keyup', function() {
    if($(this).val() == '') {
      $(this).addClass('is-invalid');
    }else{
      $(this).removeClass('is-invalid').addClass('is-valid');
    }
  })
  $('#tahun_terbit').on('keypress', function() {
    $('#bahasa').focus();
  })
  $('#bahasa').on('keyup', function() {
    if($(this).val() == '') {
      $(this).addClass('is-invalid');
    }else{
      $(this).removeClass('is-invalid').addClass('is-valid');
    }
  })
  $('#bahasa').on('keypress', function() {
    $('#genre').focus();
  })
  $('#genre').on('keyup', function() {
    if($(this).val() == '') {
      $(this).addClass('is-invalid');
    }else{
      $(this).removeClass('is-invalid').addClass('is-valid');
    }
  })
  $('#genre').on('keypress', function() {
    $('#jml_halaman').focus();
  })
  $('#jml_halaman').on('keyup', function() {
    if($(this).val() == '') {
      $(this).addClass('is-invalid');
    }else{
      $(this).removeClass('is-invalid').addClass('is-valid');
    }
  })
  $('#jml_halaman').on('keypress', function() {
    $('#stok').focus();
  })
  $('#stok').on('keyup', function() {
    if($(this).val() == '') {
      $(this).addClass('is-invalid');
    }else{
      $(this).removeClass('is-invalid').addClass('is-valid');
      $('#btn-tambah').removeAttr('disabled');
    }
  })
  $('#btn-tambah').on('click', function() {
    $(this).hide();
    $('#btn-disabled').show();
  })
})