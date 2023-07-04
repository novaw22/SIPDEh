<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LoginCredentialsRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Profile;
use App\Models\LocalCivilian;
use App\Enums\UserStatuses;

class AuthController extends Controller
{
    public function login() {
        return view("auth.login");
    }

    public function register() {
        return view("auth.register");
    }

    public function registerProcess(RegisterRequest $request) {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $password = Hash::make($data["password"]);
            $data["password"] = $password;
            $user = User::create($data);
            $data["user_id"] = $user->id;
            $civilian = LocalCivilian::where("nik", $data["nik"])->count();
            if($civilian === 1) {
                $data["status"] = UserStatuses::Local;
            }else {
                $data["status"] = UserStatuses::NonLocal;
            }
            Profile::create($data);
            DB::commit();
            return redirect()->route('auth.login')->with("success", "registrasi berhasil !");
        }catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            return back()->with("error", "registrasi gagal karena terjadi kesalahan !");
        }
    }

    public function authenticate(LoginCredentialsRequest $request) {
        $credentials = $request->validated();
        if (Auth::attempt($credentials, $request->get('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }
        return back()->withErrors([
            'email' => 'Incorrect credentials',
        ])->onlyInput('email');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.login');
    }
}
