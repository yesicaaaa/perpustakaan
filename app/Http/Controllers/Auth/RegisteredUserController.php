<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|max:13',
            'alamat'    => 'required',
            'password' => 'required|min:8',
            'confirm_password'  => 'same:password'
        ]);
        date_default_timezone_set('Asia/Jakarta');
        if($request->image != null) {
            $image = str_replace(' ', '_', $request->name) . '.' . $request->image->extension();
            $request->image->move(public_path('img/user_img'), $image);
        } else {
            $image = 'default.png';
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'alamat'    => $request->alamat,
            'image'  => $image,
            'password' => Hash::make($request->password),
            'is_active' => 0,
            'created_at'    => date('Y-m-d h:i:s'),
            'updated_at'    => null
        ]);

        $user->attachRole($request->role);

        event(new Registered($user));

        // Auth::login($user);
        if(Auth::user()->hasRole('admin')) {
            if($request->role == 'petugas'){
                return redirect('/dataPetugas')->with('status', 'Petugas baru berhasil ditambahkan.');
            }else if($request->role == 'anggota') {
                return redirect('/dataAnggota')->with('status', 'Anggota baru berhasil ditambahkan.');
            }
        } else {
            return redirect('/dataAnggotaPetugas')->with('status', 'Anggota baru berhasil ditambahkan');
        }
    }
}
