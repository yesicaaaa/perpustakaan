<div class="top-bg">
  <h1>Fiore <span>Library</span></h1>
  <img src="/img/top-bg.jpg" alt="" class="img-top">
</div>
<div class="nav-anggota">
  <h4>Menu</h4>
  <div class="divider-menu"></div>
  <div class="menu-list">
    <ul>
      <li class="{{ ($url == 'dashboard') ? 'active' : ''}}"><a href="/dashboardAnggota">Dashboard</a></li>
      <div class="divider-list"></div>
      <li class="{{ ($url == 'daftarBuku') ? 'active' : ''}}"><a href="/daftarBukuAnggota">Daftar Buku</a></li>
      <div class="divider-list"></div>
      <li class="{{ ($url == 'peminjamanSaya') ? 'active' : ''}}"><a href="/peminjamanSaya/{{Auth::user()->id}}">Peminjaman Saya</a></li>
      <div class="divider-list"></div>
      <li><a href="">History Pinjaman</a></li>
      <div class="divider-list"></div>
      <li><a href="">Profile Saya</a></li>
      <div class="divider-list"></div>
      <div class="divider-list list-end"></div>
      <li><a href="{{ route('logout') }}" onclick="return confirm('Yakin ingin keluar dari halaman?')">Log Out</a></li>
      <div class="divider-list"></div>
    </ul>
  </div>
</div>