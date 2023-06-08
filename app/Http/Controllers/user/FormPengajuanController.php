<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisDokumen;
use App\Http\Requests\StorePengajuanRequest;

class FormPengajuanController extends Controller
{
    public function showForm(JenisDokumen $jenis_dokumen) {
        $syarats = $jenis_dokumen->syarats;
        return view("form_pengajuan")->with(["syarats" => $syarats, "jenis_dokumen" => $jenis_dokumen]);
    }

    public function savePengajuan(StorePengajuanRequest $request) {
        // do something
    }
}
