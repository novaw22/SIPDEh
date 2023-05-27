<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use DB;

class KelolaDokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.kelola_dokumen.index', [
            "title" => "Kelola Dokumen",
            // "posts" => Post::all()
            "active" => "Pengajuan",
            "table_id" => "kelola_dokumen_id"
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input
        $validator = Validator::make($request->all(), [
            'nik' => 'required|max:16',
            'nama' => 'required|max:50',
        ]);

        // If validation fails, return the error response
        if ($validator->fails()) {
            return response()->json([
                'success' => 0,
                'msg' => 'Validation Error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = Penduduk::updateOrCreate(
            ['id' => $request->data_id],
            ['nik' => $request->nik, 'nama' => $request->nama]
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
    public function show(Penduduk $penduduk)
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
    public function update(Request $request, Penduduk $penduduk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Penduduk::find($id); 
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
