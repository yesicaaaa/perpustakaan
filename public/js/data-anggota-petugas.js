$(document).ready(function() {
  $('#btn-disabled').hide();
  $('#name').on('keyup', function() {
    if($(this).val() == '') {
      $(this).addClass('is-invalid');
    }else{
      $(this).removeClass('is-invalid').addClass('is-valid');
    }
  })
  $('#name').on('keypress', function() {
    $('#email').focus();
  })
  $('#email').on('keyup', function() {
    if($(this).val() == '') {
      $(this).addClass('is-invalid');
    }else{
      $(this).removeClass('is-invalid').addClass('is-valid');
    }
  })
  $('#email').on('keypress', function() {
    $('#phone').focus();
  })
  $('#phone').on('keyup', function() {
    if($(this).val() == '') {
      $(this).addClass('is-invalid');
    }else{
      $(this).removeClass('is-invalid').addClass('is-valid');
    }
  })
  $('#phone').on('keypress', function() {
    $('#alamat').focus();
  })
  $('#alamat').on('keyup', function() {
    if($(this).val() == '') {
      $(this).addClass('is-invalid');
    }else{
      $(this).removeClass('is-invalid').addClass('is-valid');
    }
  })
  $('#alamat').on('keypress', function() {
    $('#password').focus();
  })
  $('#password').on('keyup', function() {
    if($(this).val() == '') {
      $(this).addClass('is-invalid');
    }else{
      $(this).removeClass('is-invalid').addClass('is-valid');
    }
  })
  $('#password').on('keypress', function() {
    $('#confirm_password').focus();
  })
  $('#confirm_password').on('keyup', function() {
    if($(this).val() == '') {
      $(this).addClass('is-invalid');
    }else{
      $(this).removeClass('is-invalid').addClass('is-valid');
    }
  })
  $('#confirm_password').on('keypress', function() {
    $('#btn-tambah').removeAttr('disabled');
  })
  $('#btn-tambah').on('click', function() {
    $(this).hide();
    $('#btn-disabled').show();
  });

  if($('.is_active').text() == 'Offline') {
    $(this).css('color', 'red');
  }else{
    $(this).css('color', 'green');  
  }
});