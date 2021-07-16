<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller {
  public function index()
  {
    if (Auth::user()->hasRole('admin')) {
      return redirect('/dashboardAdmin')->with('status', 'Anda berhasil login.');
    } elseif (Auth::user()->hasRole('petugas')) {
      return redirect('/dashboardPetugas')->with('status', 'Anda berhasil login sebagai petugas.');
    } elseif (Auth::user()->hasRole('anggota')) {
      return redirect('/pengaduan_saya')->with('status', 'Anda berhasil login sebagai masyarakat.');
    }
  }
}


?>