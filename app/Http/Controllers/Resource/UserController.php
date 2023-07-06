<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAdminUserProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Enums\UserRoles;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->query("q", "");
        $users = User::where("role", UserRoles::User)
            ->where("email", "LIKE", "%{$keyword}%")
            ->orderBy("email")
            ->paginate(5)
            ->withQueryString();
        return view("admin.users.index")->with([
            "users" => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view("admin.users.detail")->with("user", $user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminUserProfileRequest $request, User $user)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            DB::commit();
            if(empty($data["password"])){
                unset($data['password']);
            }
            $user->update($data);
            $profile = $user->profile;
            $profile->update($data);
            return redirect()->route('admin.users.index')->with("success", "proses update berhasil");
        }catch(\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with("error", "proses update gagal");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route("admin.users.index")->with("error", "berhasil menghapus user");
    }
}
