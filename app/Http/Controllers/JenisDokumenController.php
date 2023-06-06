<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJenisDokumenRequest;
use App\Http\Requests\UpdateJenisDokumenRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\JenisDokumen;
use Yajra\DataTables\DataTables;
use DB;

class JenisDokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.jenis_dokumen.index', [
            "title" => "Jenis Dokumen",
            // "posts" => Post::all()
            "active" => "Master",
            "table_id" => "jenis_dokumen_id"
        ]);
    }

    public function getData(Request $request)
    {

        $data = DB::table('jenis_dokumens')->whereNull('deleted_at')->get();

        $datatables = DataTables::of($data);
		return $datatables
        ->addIndexColumn()
        ->addColumn('action', function($data){
            $actionBtn = "
            <a href='javascript:void(0)' data-id='{$data->id}'  class='btn btn-icon btn-primary editData' title='edit data'><span class='tf-icons bx bx-edit-alt'></span></a>
            <a href='javascript:void(0)' onclick='deleteData(\"{$data->id}\")' data-id='{$data->id}' class='btn btn-icon btn-danger' title='hapus data'><span class='tf-icons bx bx-trash'></span></a>
            ";
            return $actionBtn;
        })
        ->rawColumns(['action'])
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
            'name' => 'required|max:50',
        ]);

        // If validation fails, return the error response
        if ($validator->fails()) {
            return response()->json([
                'success' => 0,
                'msg' => 'Validation Error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = JenisDokumen::updateOrCreate(
            ['id' => $request->data_id],
            ['name' => $request->name]
        );

        if($data){
            $response = array('success'=>1,'msg'=>'Data berhasil disimpan');
        }else{
            $response = array('error'=>2,'msg'=>'Data gagal disimpan');
        }
        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisDokumen $jenisDokumen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $jenisDokumen = JenisDokumen::find($id);
        return response()->json($jenisDokumen);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JenisDokumen $jenisDokumen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = JenisDokumen::find($id);
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
