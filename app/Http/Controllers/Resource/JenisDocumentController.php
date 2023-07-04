<?php

namespace App\Http\Controllers\Resource;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use App\Models\JenisDocument;
use App\Models\JenisDocumentUser;
use App\Models\SpecialTerm;
use App\Http\Requests\StoreJenisDocumentRequest;
use App\Http\Requests\UpdateJenisDocumentRequest;
use App\Http\Controllers\Controller;
use App\Enums\UserStatuses;
use App\Enums\SpecialTermTypes;
use Illuminate\Validation\ValidationException;

class JenisDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        $keyword = $request->query("q", "");
        $types = JenisDocument::where("name", "LIKE", "%{$keyword}%")
            ->orderBy("name")
            ->paginate(5)
            ->withQueryString();
        return view("admin.documents.index")->with([
            "types" => $types
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $userStatuses = UserStatuses::cases();
        $specialTermTypes = SpecialTermTypes::cases();
        
        return view('admin.documents.create')->with([
            "userStatuses" => $userStatuses,
            "specialTermTypes" => $specialTermTypes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJenisDocumentRequest $request)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $document = JenisDocument::create($data);
            $userStatuses = UserStatuses::cases();

            foreach($userStatuses as $userStatus) {
                if($request->has($userStatus->value)) {
                    JenisDocumentUser::create([
                        "jenis_document_id" => $document->id,
                        "user_status" => $userStatus->value
                    ]);
                }
            }
            $requestData = $request->all();
            $specialTermNames = array_values(array_filter($requestData, function($v) use($requestData){
                return preg_match('#specialTermName\d#', array_search($v, $requestData));
            }));
            $specialTermTypes = array_values(array_filter($requestData, function($v) use($requestData){
                return preg_match('#specialTermType\d#', array_search($v, $requestData));
            }));
            $specialTermNameType = array_map( function($specialTermNames, $specialTermTypes) {
                return [$specialTermNames => $specialTermTypes];
            }, $specialTermNames, $specialTermTypes);
            
            if(count($specialTermNameType) > 0){
                foreach($specialTermNameType as $nameType) {
                    $name = array_key_first($nameType);
                    if(!empty($name)) {
                        SpecialTerm::create([
                            "jenis_document_id" => $document->id,
                            "name" => array_key_first($nameType),
                            "type" => $nameType[array_key_first($nameType)],
                        ]);
                    } else {
                        throw abort(400);
                    }
                }
            }
                
            DB::commit();
            return redirect()->route("admin.documents.index")->with("success", "berhasil membuat jenis dokumen");
        }catch(\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with("error", "terjadi kesalahan saat menyimpan data");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisDocument $document)
    {
        $documentUsers = $document->jenis_document_user;
        $specialTerms = $document->special_terms;
        return view("admin.documents.detail")->with([
            "document" => $document,
            "documentUsers" => $documentUsers,
            "specialTerms" => $specialTerms,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisDocument $jenisDocument)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJenisDocumentRequest $request, JenisDocument $jenisDocument)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisDocument $document)
    {
        $document->delete();
        return redirect()->route('admin.documents.index')->with("error", "berhasil menghapus jenis dokumen");
    }
}
