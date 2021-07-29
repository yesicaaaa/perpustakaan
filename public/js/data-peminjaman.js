$(document).ready(function() {
  $('.data-buku').load('petugas/dataPeminjaman.php');
  $('#btn-peminjaman-tunggu').hide();
  $('#id_anggota').on('keyup', function() {
    if($(this).val() == '') {
      $(this).addClass('is-invalid');
    }else{
      $(this).removeClass('is-invalid').addClass('is-valid')
    }
  })
  $('#id_anggota').on('keypress', function() {
    $('#id_buku').focus()
  })
  $('#id_buku').on('keyup', function() {
    if($(this).val() == '') {
      $(this).addClass('is-invalid');
    }else{
      $(this).removeClass('is-invalid').addClass('is-valid')
    }
  })
  $('#id_buku').on('keypress', function() {
    $('#qty').focus()
  })
  $('#qty').on('keyup', function() {
    if($(this).val() == '') {
      $(this).addClass('is-invalid');
    }else{
      $(this).removeClass('id-invalid').addClass('is-valid')
    }
  })
  $('#tgl_pinjam').on('click', function() {
    $('#btn-peminjaman-simpan').removeAttr('disabled')
  })
  $('#btn-peminjaman-simpan').on('click', function() {
    $(this).hide();
    $('#btn-peminjaman-tunggu').show();
  })
  
  // var data = $('#form-data').serialize();
  // $.ajax({
  //   method: 'POST',
  //   url: '/tambahPeminjaman/',
  //   data: data,
  //   success: function() {
  //     $('.data-buku').load('petugas/data-peminjaman.php');
  //     $('#form-data').reset();
  //   }
  // })

  $('.data-buku').DataTable();
})