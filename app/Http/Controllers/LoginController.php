<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('user/kelola-dokumen');
        }else{
            return view('auth.login');
        }
    }

    public function actionlogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'The email field is required.',
            'password.required' => 'The password field is required.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        $status = User::where('email', $request->email)->first();

        if (Auth::Attempt($data)) {
            if ($status->status == 'admin') {
                return redirect('admin/dashboard');
            }else{
                return redirect('user/dashboard');
            }
        }else{
            Session::flash('error', 'Email atau Password Salah');
            return redirect('/login');
        }
    }

    public function actionlogout()
    {
        Auth::logout();
        return redirect('/');
    }
}
