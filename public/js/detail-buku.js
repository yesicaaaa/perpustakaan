$(document).ready(function(){
  $('#editJudul').on('keyup', function() {
    if($(this).val() == ''){
      $(this).addClass('is-invalid');
    }else{
      $(this).removeClass('is-invalid');
    }
  });
  $('#editPengarang').on('keyup', function() {
    if($(this).val() == ''){
      $(this).addClass('is-invalid');
    }else{
      $(this).removeClass('is-invalid');
    }
  });
  $('#editPenerbit').on('keyup', function() {
    if($(this).val() == ''){
      $(this).addClass('is-invalid');
    }else{
      $(this).removeClass('is-invalid');
    }
  });
  $('#editTahun_terbit').on('keyup', function() {
    if($(this).val() == ''){
      $(this).addClass('is-invalid');
    }else{
      $(this).removeClass('is-invalid');
    }
  });
  $('#editBahasa').on('keyup', function() {
    if($(this).val() == ''){
      $(this).addClass('is-invalid');
    }else{
      $(this).removeClass('is-invalid');
    }
  });
  $('#editGenre').on('keyup', function() {
    if($(this).val() == ''){
      $(this).addClass('is-invalid');
    }else{
      $(this).removeClass('is-invalid');
    }
  });
  $('#editJml_halaman').on('keyup', function() {
    if($(this).val() == ''){
      $(this).addClass('is-invalid');
    }else{
      $(this).removeClass('is-invalid');
    }
  });
});