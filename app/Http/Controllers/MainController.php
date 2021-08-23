<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller {
  public function index()
  {
    if (Auth::user()->hasRole('admin')) {
      return redirect('/dashboardAdmin');
    } elseif (Auth::user()->hasRole('petugas')) {
      return redirect('/dashboardPetugas');
    } elseif (Auth::user()->hasRole('anggota')) {
      return redirect('/dashboardAnggota');
    }
  }
}


?>