<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\JenisDokumen;
use App\Models\SyaratPengajuan;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.dashboard')
                ->with('penduduk_count', Penduduk::all()->count())
                ->with('jenis_dokumen_count', JenisDokumen::all()->count())
                ->with('pengajuan_dokumen_count', Pengajuan::all()->count())
                ->with('syarat_pengajuan_count', SyaratPengajuan::all()->count());
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
    public function show(Penduduk $penduduk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penduduk $penduduk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penduduk $penduduk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penduduk $penduduk)
    {
        //
    }
}
