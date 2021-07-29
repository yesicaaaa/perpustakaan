@extends('layout.template')
@extends('layout.sidenav')
@section('css', 'petugas.css')
@section('js', 'data-peminjaman.js')
@section('sidenavcss', 'sidenav.css')
@section('title', 'Data Peminjaman | Fiore Library')
@section('content')
<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Data Peminjaman</li>
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
  <div class="form-peminjaman">
    <div class="row">
      <h6>Catat Peminjaman</h6>
      <div class="col-md-6 catat-peminjaman">
        <form action="/tambahPeminjaman" method="POST" id="form-data">
          <input type="hidden" name="_method" value="POST">
          @csrf
          <input type="hidden" name="id_petugas" value="{{Auth::user()->id}}">
          <div class="mb-3">
            <label for="name" class="form-label">ID Peminjam<span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('id_anggota') is-invalid @enderror" list="anggotaDatalist" id="id_anggota" name="id_anggota" value="{{ old('id_anggota') }}" autocomplete="off">
            <datalist id="anggotaDatalist">
              @foreach($anggota as $a)
              <option value="{{$a->id}}">{{$a->name}}</option>
              @endforeach
            </datalist>
            <div class="invalid-feedback">
              @error('id_anggota')
              {{ $message }}
              @enderror
            </div>
          </div>
          <div class="mb-3">
            <label for="id_buku" class="form-label">ID Buku<span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('id_buku') is-invalid @enderror" list="bukuDatalist" id="id_buku" name="id_buku" value="{{ old('id_buku') }}" autocomplete="off">
            <datalist id="bukuDatalist">
              @foreach($buku as $b)
              <option value="{{$b->id_buku}}">{{$b->judul}}</option>
              @endforeach
            </datalist>
            <div class="invalid-feedback">
              @error('id_buku')
              {{ $message }}
              @enderror
            </div>
          </div>
        </div>
        <div class="col-md-6">
        <div class="mb-3">
          <label for="qty" class="form-label">Jumlah Buku Dipinjam<span class="text-danger">*</span></label>
          <input type="number" class="form-control @error('qty') is-invalid @enderror" id="qty" name="qty" value="{{ old('qty') }}" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
          <div class="invalid-feedback">
            @error('qty')
            {{ $message }}
            @enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="tgl_pinjam" class="form-label">Tanggal Pinjam<span class="text-danger">*</span></label>
          <input type="date" class="form-control @error('tgl_pinjam') is-invalid @enderror" id="tgl_pinjam" name="tgl_pinjam" value="{{ old('tgl_pinjam') }}">
          <div class="invalid-feedback">
            @error('tgl_pinjam')
            {{ $message }}
            @enderror
          </div>
        </div>
        <!-- <div class="mb-3">
          <label for="tgl_hrs_kembali" class="form-label">Tanggal Harus Kembali<span class="text-danger">*</span></label>
          <input type="date" class="form-control @error('tgl_hrs_kembali') is-invalid @enderror" id="tgl_hrs_kembali" name="tgl_hrs_kembali" value="{{ old('tgl_hrs_kembali') }}">
          <div class="invalid-feedback">
            @error('tgl_hrs_kembali')
            {{ $message }}
            @enderror
          </div>
        </div> -->
        <button type="submit" class="btn btn-peminjaman" id="btn-peminjaman-simpan" onclick="return confirm('yakin ingin melakukan peminjaman buku?')" disabled>Simpan</button>
        <button type="submit" class="btn btn-peminjaman" id="btn-peminjaman-tunggu" disabled>Tunggu ....</button>
        </form>
      </div>
    </div>
  </div>
  <table class="table table-striped table-bordered data-buku">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Detail</th>
      </tr>
    </thead>
    <tbody>
      @foreach($peminjaman as $p)
      <tr>
        <td>AGT{{str_pad($p->id, 4, 0, STR_PAD_LEFT)}}</td>
        <td>{{$p->name}}</td>
        <td>
          <a href="/detailPeminjaman/{{$p->id}}" class="badge bg-success">Lihat>></a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<script>
  var base_url = 'http://localhost:8000/';
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
</script>
@endsection