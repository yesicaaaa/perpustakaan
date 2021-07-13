$(document).ready(function() {
    $('.btn-able').hide();
    $('#judul').on('keyup', function() {
      if($(this).val() == ''){
        $(this).removeClass('is-valid').addClass('is-invalid');
      }else{
        $(this).removeClass('is-invalid').addClass('is-valid');
      }
    });
    $('#judul').on('keypress', function() {
      if ($(this).val() != '') {
        $('#pengarang').focus();
      }
    });

    $('#pengarang').on('keyup', function() {
      if($(this).val() == ''){
        $(this).removeClass('is-valid').addClass('is-invalid');
      }else{
        $(this).removeClass('is-invalid').addClass('is-valid');
      }
    });
    $('#pengarang').on('keypress', function() {
      if ($(this).val() != '') {
        $('#penerbit').focus();
      }
    });

    $('#penerbit').on('keyup', function() {
      if($(this).val() == ''){
        $(this).removeClass('is-valid').addClass('is-invalid');
      }else{
        $(this).removeClass('is-invalid').addClass('is-valid');
      }
    });
    $('#penerbit').on('keypress', function() {
      if ($(this).val() != '') {
        $('#tahun_terbit').focus();
      }
    });

    $('#tahun_terbit').on('keyup', function() {
      if($(this).val() == ''){
        $(this).removeClass('is-valid').addClass('is-invalid');
      }else{
        $(this).removeClass('is-invalid').addClass('is-valid');
      }
    });
    $('#tahun_terbit').on('keypress', function() {
      if ($(this).val() != '') {
        $('#bahasa').focus();
      }
    });

    $('#bahasa').on('keyup', function() {
      if($(this).val() == ''){
        $(this).removeClass('is-valid').addClass('is-invalid');
      }else{
        $(this).removeClass('is-invalid').addClass('is-valid');
      }
    });
    $('#bahasa').on('keypress', function() {
      if ($(this).val() != '') {
        $('#genre').focus();
      }
    });

    $('#genre').on('keyup', function() {
      if($(this).val() == ''){
        $(this).removeClass('is-valid').addClass('is-invalid');
      }else{
        $(this).removeClass('is-invalid').addClass('is-valid');
      }
    });
    $('#genre').on('keypress', function() {
      if ($(this).val() != '') {
        $('#jml_halaman').focus();
      }
    });

    $('#jml_halaman').on('keyup', function() {
      if($(this).val() == ''){
        $(this).removeClass('is-valid').addClass('is-invalid');
      }else{
        $(this).removeClass('is-invalid').addClass('is-valid');
      }
    });
    $('#jml_halaman').on('keypress', function() {
      if ($(this).val() != '') {
        $('#stok').focus();
      }
    });

    $('#stok').on('keyup', function() {
      if($(this).val() == ''){
        $(this).removeClass('is-valid').addClass('is-invalid');
      }else{
        $(this).removeClass('is-invalid').addClass('is-valid');
      }
    });
    $('#stok').on('keypress', function() {
      if ($(this).val() != '') {
        $('.btn-tambah-buku').removeAttr('disabled');
      }
    });
  });