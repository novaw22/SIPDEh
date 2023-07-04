<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use DB;
use Illuminate\Validation\Rule;

class PendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.penduduk.index', [
            "title" => "Penduduk",
            // "posts" => Post::all()
            "active" => "Master",
            "table_id" => "penduduk_id"
        ]);
    }

    public function getData(Request $request)
    {

        $data = DB::table('penduduks')->whereNull('deleted_at')->get();

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
            'nik' => [
                'required',
                'digits:16',
                'numeric',
                Rule::unique('penduduks')->ignore($request->data_id)
            ],
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
            $response = array('success'=>1,'msg'=>'Data berhasil disimpan');
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
        $penduduk = Penduduk::find($id);
        return response()->json($penduduk);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penduduk $penduduk)
    {
        $validator = Validator::make($request->all(), [
            'nik' => [
                'required',
                'digits:16',
                'numeric',
                Rule::unique('penduduks')->ignore($request->data_id)
            ],
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

        // Update the fields
        $penduduk->nama = $request->nama;

        if ($penduduk->save()) {
            $response = array('success' => 1, 'msg' => 'Data berhasil diperbarui');
        } else {
            $response = array('error' => 2, 'msg' => 'Gagal memperbarui data');
        }
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Penduduk::find($id);
        $data->nik = 'deleted';
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
