<nav class="navbar navbar-expand-lg navbar-light bg-blue sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="/dashboard">Fiore <span>Library</span></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    </ul>
  </div>
  <div class="sidenav">
    <div class="row user-info">
      <div class="col-md-4">
        <img src="/img/user_img/{{ Auth::user()->image }}" alt="user_photo">
      </div>
      <div class="col-md-8">
        <h5>{{ Auth::user()->name }}</p>
          @if(Auth::user()->hasRole('admin'))
          <h6>Administrator</h6>
          @elseif(Auth::user()->hasRole('petugas'))
          <h6>Petugas</h6>
          @else
          <h6>Anggota</h6>
          @endif
          <div class="row">
            <div class="col-md-6">
              <a href="" data-bs-toggle="tooltip" data-bs-placement="top" title="Profile Saya"><i class="fa fa-fw fa-user"></i></a>
            </div>
            <div class="col-md-6">
              <a href="{{ route('logout') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Keluar" onclick="return confirm('Yakin ingin keluar dari halaman?')"><i class="bi-box-arrow-in-left"></i></a>
            </div>
          </div>
      </div>
    </div>
    <div class="menu-list">
      <ul>
        <li><a href=""><i class="fa fa-fw fa-home"></i> Dashboard</a></li>
        <li><a href="daftarBuku"><i class="fa fa-fw fa-book"></i> Daftar Buku</a></li>
        <li><a href=""><i class="fa fa-fw fa-address-book"></i> Data Petugas</a></li>
        <li><a href=""><i class="fa fa-fw fa-address-book"></i> Data Anggota</a></li>
        <li><a href=""><i class="fa fa-fw fa-clipboard"></i> Laporan Peminjaman</a></li>
        <li><a href=""><i class="fa fa-fw fa-clipboard"></i> Laporan Pengembalian</a></li>
        <li><a href=""><i class="fa fa-fw fa-copy"></i> Generate Laporan</a></li>
      </ul>
    </div>
  </div>
</nav>