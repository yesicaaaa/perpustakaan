@extends('layout.template')
@extends('layout.sidenav')
@section('css', 'admin.css')
@section('sidenavcss', 'sidenav.css')
@section('title', 'Daftar Buku | Fiore Library')
@section('js', 'daftar_buku.js')
@section('content')
<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-fw fa-book"></i> Daftar Buku</li>
    </ol>
  </nav>
  <div class="row daftar-buku">
    <div class="col-md-3 tambah-buku">
      <h6>Tambah Buku</h6>
      <form action="tambahBuku" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="judul" class="form-label">Judul<span class="text-danger">*</span></label>
          <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul') }}">
          <div class="invalid-feedback">
            @error('judul')
            {{ $message }}
            @enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="pengarang" class="form-label">Pengarang<span class="text-danger">*</span></label>
          <input type="text" class="form-control @error('pengarang') is-invalid @enderror" id="pengarang" name="pengarang" value="{{ old('pengarang') }}">
          <div class="invalid-feedback">
            @error('pengarang')
            {{ $message }}
            @enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="penerbit" class="form-label">Penerbit<span class="text-danger">*</span></label>
          <input type="text" class="form-control @error('penerbit') is-invalid @enderror" id="penerbit" name="penerbit" value="{{ old('penerbit') }}">
          <div class="invalid-feedback">
            @error('penerbit')
            {{ $message }}
            @enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="tahun_terbit" class="form-label">Tahun Terbit<span class="text-danger">*</span></label>
          <input type="text" class="form-control @error('tahun_terbit') is-invalid @enderror" id="tahun_terbit" name="tahun_terbit" value="{{ old('tahun_terbit') }}" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
          <div class="invalid-feedback">
            @error('tahun_terbit')
            {{ $message }}
            @enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="bahasa" class="form-label">Bahasa<span class="text-danger">*</span></label>
          <input type="text" class="form-control @error('bahasa') is-invalid @enderror" id="bahasa" name="bahasa" value="{{ old('bahasa') }}">
          <div class="invalid-feedback">
            @error('bahasa')
            {{ $message }}
            @enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="genre" class="form-label">Genre<span class="text-danger">*</span></label>
          <input type="text" class="form-control @error('genre') is-invalid @enderror" list="datalistOptions" id="genre" name="genre" value="{{ old('genre') }}" autocomplete="off">
          <datalist id="datalistOptions">
            <option value="Drama">
            <option value="Aksi">
            <option value="Komedi">
            <option value="Horor">
            <option value="Romantis">
            <option value="Fantasi">
            <option value="Adventure">
            <option value="Thiller">
            <option value="Sci-Fi">
            <option value="Misteri">
            <option value="Dokumenter">
            <option value="Pelajaran">
            <option value="Biografi">
          </datalist>
          <div class="invalid-feedback">
            @error('genre')
            {{ $message }}
            @enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="jml_halaman" class="form-label">Jumlah Halaman<span class="text-danger">*</span></label>
          <input type="text" class="form-control @error('jml_halaman') is-invalid @enderror" id="jml_halaman" name="jml_halaman" value="{{ old('jml_halaman') }}" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
          <div class="invalid-feedback">
            @error('jml_halaman')
            {{ $message }}
            @enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="foto" class="form-label">Foto Buku</label>
          <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto">
          <div class="invalid-feedback">
            @error('foto')
            {{ $message }}
            @enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="stok" class="form-label">Stok<span class="text-danger">*</span></label>
          <input type="text" class="form-control @error('stok') is-invalid @enderror" id="stok" name="stok" value="{{ old('stok') }}" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
          <div class="invalid-feedback">
            @error('stok')
            {{ $message }}
            @enderror
          </div>
        </div>
        <button class="btn btn-tambah-buku" onclick="return confirm('Yakin ingin menambahkan buku baru?')" type="submit" disabled>Tambah</button>
        <button class="btn btn-tambah-buku-tunggu" disabled>Tunggu...</button>
      </form>
    </div>
    <div class="col-md-9">
      @if(session('status'))
      <div class="alert alert-success" role="alert">
        {{session('status')}}
        <button type="button" class="btn-close btn-close-alert" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @elseif(session('err'))
      <div class="alert alert-danger" role="alert">
        {{session('err')}}
        <button type="button" class="btn-close btn-close-alert" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
      <!-- <form action="/daftarBuku" method="get">
        @csrf
        <input type="text" name="cari" class="form-control form-search" placeholder="Cari...">
        <button class="btn btn-search" type="Submit">Cari</button>
      </form>
      <a href="/refreshBuku" class="btn btn-refresh">Refresh</a> -->
      <div class="buku-table">
        <form action="hapusBuku" method="post">
          @csrf
          <button type="submit" class="btn btn-hapus btn-daftar-buku" id="hapus_buku" onclick="return confirm('Yakin ingin menghapus data buku?')"><i class="fa fa-fw fa-minus-circle"></i> Hapus</button>
          <a href="/exportBukuExcel" class="btn btn-daftar-buku btn-export" onclick="return confirm('Yakin ingin mengexport data buku?')"><i class="fa fa-fw fa-download"></i>Excel</a>
          <a href="/exportBukuPdf" class="btn btn-daftar-buku btn-export" onclick="return confirm('Yakin ingin mengexport data buku?')"><i class="fa fa-fw fa-download"></i>PDF</a>
          <table class="table table-daftar-buku">
            <thead class="table-orange">
              <tr>
                <th scope="col"></th>
                <th scope="col">Kode Buku</th>
                <th scope="col">Judul</th>
                <th scope="col" class="column-foto">Foto</th>
                <th scope="col">Stok</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($buku as $index => $b)
              <tr>
                <th scope="row">
                  <input type="checkbox" name="id[]" id="id" class="idBukucheck" value="{{$b->id_buku}}">
        </form>
        </th>
        <td>BK{{str_pad($b->id_buku, 4, '0', STR_PAD_LEFT)}}</td>
        <td>{{$b->judul}}</td>
        <td><img class="img-buku" src="/img/buku/{{$b->foto}}" alt=""></td>
        <td>{{$b->stok}}</td>
        <td>
          <a href="detailBuku/{{$b->id_buku}}" class="badge bg-success">Detail</a>
        </td>
        </tr>
        @endforeach
        </tbody>
        </table>
      </div>
      @if(empty($buku))
      <div class="alert alert-danger alert-not-found">
        Data buku tidak ditemukan!
      </div>
      @endif
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('.table-daftar-buku').DataTable();
  });
</script>
@endsection