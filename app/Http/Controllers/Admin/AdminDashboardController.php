<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function dashboard(Request $request) {
        $user = $request->user();
        $submissions = $user->submissions->take(4);
        return view("admin.dashboard")->with("submissions", $submissions);
    }
    public function profile(Request $request) {
        $user = $request->user();
        $profile = $user->profile;
        return view("admin.profile")->with([
            "user" => $user,
            "profile" => $profile
        ]);
    }
    public function profileSave(UpdateUserProfileRequest $request, User $user) {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            if(empty($data["password"])) {
                unset($data['password']);
            }
            $user->update($data);
            $profile = $user->profile;
            $profile->update($data);
            DB::commit();
            return redirect()->back()->with("success", "berhasil update profile");
        }catch(\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with("error", "terjadi kesalahan !");
        }
    }
}
