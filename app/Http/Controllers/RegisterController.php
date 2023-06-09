<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Penduduk;
use Session;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function actionregister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'unique:users|required|digits:16',
            'email' => 'unique:users|required',
            'password' => 'required',
        ], [
            'nik.unique' => 'The NIK has already been taken.',
            'nik.required' => 'The NIK field is required.',
            'email.unique' => 'The email has already been taken.',
            'email.required' => 'The email field is required.',
            'password.required' => 'The password field is required.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $penduduk = Penduduk::where('nik', $request->nik)->first();

        if ($penduduk) {
            $user = User::create([
                'email' => $request->email,
                'nik' => $request->nik,
                'status' => 'warga',
                'password' => Hash::make($request->password),
            ]);
        } else {
            $user = User::create([
                'email' => $request->email,
                'nik' => $request->nik,
                'status' => 'bukan warga',
                'password' => Hash::make($request->password),
            ]);
        }


        Session::flash('message', 'Register Berhasil. Akun Anda sudah Aktif silahkan Login menggunakan username dan password.');
        return redirect('register');
    }
}
