<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Users extends Controller
{
    public function login()
    {
        //Validasi input dari user
        $validator = Validator::make(request()->all(), [
            'email' => 'required',
            'password' => 'required'
        ], [
            //Beri pesan error kustom
            'email.required' => 'Email Wajib Diisi',
            'password.required' => 'Password Wajib Diisi'
        ]);

        //Jika gagal maka return dengan error dan keluar dari method
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        };

        //Jika berhasil tampung inputan dalam array
        $credentials = array(
            'email' => request()->input('email'),
            'password' => request()->input('password')
        );

        //Cek kecocokan email dan password
        if (Auth::attempt($credentials)) {

            //Buat session untuk autentikasi middleware dan arahkan ke dashboard
            request()->session()->regenerate();
            return redirect()->intended('kategori');
        };

        //Jika gagal kembali dengan pesan error
        return redirect()->back()->with('fail', 'Data Kredensial Salah');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }
}
