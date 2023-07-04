<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePengajuanRequest;
use App\Http\Requests\UpdatePengajuanRequest;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Models\JenisDokumen;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documentTypes = JenisDokumen::all();
        return view('user.kelola_dokumen.index', [
            "title" => "Kelola Dokumen",
            // "posts" => Post::all()
            "active" => "Pengajuan",
            "table_id" => "kelola_dokumen_id",
            "types" => $documentTypes
        ]);
    }

    public function getData(Request $request)
    {

        $data = DB::table('pengajuans')->whereNull('deleted_at')->get();

        $datatables = DataTables::of($data);
		return $datatables
        ->addIndexColumn()
        ->addColumn('status_dokumen', function($data){
            $statusBadge = "";
            if ($data->status == 'disetujui') {
                $statusBadge = '<span class="badge rounded-pill bg-success">Disetujui</span>';
            } elseif ($data->status == 'belum disetujui') {
                $statusBadge = '<span class="badge rounded-pill bg-info">Belum Disetujui</span>';
            } elseif ($data->status == 'ditolak') {
                $statusBadge = '<span class="badge rounded-pill bg-danger">Ditolak</span>';
            }
            return $statusBadge;
        })
        ->addColumn('action', function($data){
            $actionBtn = "
            <a href='/admin/kelola-dokumen/{$data->id}/edit' class='btn btn-icon btn-primary' title='edit data'><span class='tf-icons bx bx-edit-alt'></span></a>
            <a href='javascript:void(0)' onclick='deleteData(\"{$data->id}\")' data-id='{$data->id}' class='btn btn-icon btn-danger' title='hapus data'><span class='tf-icons bx bx-trash'></span></a>
            ";
            return $actionBtn;
        })
        ->rawColumns(['status_dokumen', 'action'])
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $jenis_dokumen_id = $request->jenis_dokumen;
        
        $jenis_dokumen = JenisDokumen::findOrFail($jenis_dokumen_id);

        $syarats = $jenis_dokumen->syarats;
        return view('user.kelola_dokumen.add',[
            'jenis_dokumen' => $jenis_dokumen,
            'syarats' => $syarats
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input
        $validator = Validator::make($request->all(), [
            'nama_pengaju' => 'required',
            'dokumen' => 'required',
            'status' => 'required',
            'alasan' => 'required'
        ]);

        // If validation fails, return the error response
        if ($validator->fails()) {
            return response()->json([
                'success' => 0,
                'msg' => 'Validation Error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = Pengajuan::updateOrCreate(
            ['id' => $request->data_id],
            ['nama_pengaju' => $request->nama_pengaju, 'dokumen' => $request->dokumen, 'status' => $request->status, 'alasan' => $request->alasan]
        );

        if($data){
            $response = array('success'=>1,'msg'=>'Data berhasl disimpan');
        }else{
            $response = array('error'=>2,'msg'=>'Data gagal disimpan');
        }
        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        return view('admin.kelola_dokumen.detail', [
            "data" => Pengajuan::find($id),
            "title" => "Kelola Dokumen",
            "active" => "Master"
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Pengajuan::find($id);
        $data->deleted_at = date('Y-m-d H:i:s');
        //$data->updated_by = auth()->user()->id;
        if($data->save()){
            $response = array('success'=>1,'msg'=>'Berhasil hapus data');
        }else{
            $response = array('error'=>2,'msg'=>'Gagal hapus data');
        }
        return $response;
    }
}