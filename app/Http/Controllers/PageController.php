<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enums\UserRoles;

class PageController extends Controller
{
    public function dashboard(Request $request) {
        $user = $request->user();
        if($user->role === UserRoles::Admin->value) {
            return redirect()->route('admin.dashboard');
        }
        if($user->role === UserRoles::User->value) {
            return redirect()->route('user.dashboard');
        }
        return redirect()->route("landing");
    }

    public function profile(Request $request) {
        $user = $request->user();
        if($user->role === UserRoles::Admin->value) {
            return redirect()->route('admin.profile');
        }
        if($user->role === UserRoles::User->value) {
            return redirect()->route('user.profile');
        }
        return redirect()->route("landing");
    }
}
