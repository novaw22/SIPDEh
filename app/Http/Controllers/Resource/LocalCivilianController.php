<?php

namespace App\Http\Controllers\Resource;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LocalCivilian;
use App\Http\Requests\StoreLocalCivilianRequest;
use App\Http\Requests\UpdateLocalCivilianRequest;

class LocalCivilianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->query("q", "");
        $civilians = LocalCivilian::where("fullname", "LIKE", "%{$keyword}")
            ->orWhere("nik", $keyword)
            ->orderBy("fullname")
            ->paginate(5)
            ->withQueryString();
        return view('admin.civilians.index')->with("civilians", $civilians);       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.civilians.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLocalCivilianRequest $request)
    {
        $data = $request->validated();
        $data["age"] = Carbon::parse($data["date_of_birth"])->age;
        LocalCivilian::create($data);
        return redirect()->route("admin.civilians.index")->with("success", "berhasil membuat penduduk");
    }

    /**
     * Display the specified resource.
     */
    public function show(LocalCivilian $civilian)
    {
        return view("admin.civilians.detail")->with("civilian", $civilian);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LocalCivilian $civilian)
    {
        return view('admin.civilians.edit')->with('civilian',$civilian);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocalCivilianRequest $request, LocalCivilian $civilian)
    {
        $data = $request->validated();
        $data["age"] = Carbon::parse($data["date_of_birth"])->age;
        $civilian->update($data);
        return redirect()->route('admin.civilians.index')->with("success", "berhasil update penduduk");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LocalCivilian $civilian)
    {
        $civilian->delete();
        return redirect()->route('admin.civilians.index')->with('error', "berhasil menghapus penduduk");
    }
}
