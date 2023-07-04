<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreUserSubmissionRequest;
use App\Http\Requests\UpdateUserSubmissionRequest;
use App\Models\Submission;
use App\Models\SubmissionDetail;
use App\Models\JenisDocument;
use App\Enums\SpecialTermTypes;
use App\Enums\SubmissionStatuses;

class UserSubmissionController extends Controller
{
    public function index(Request $request) {
        $user = $request->user();
        $submissions = $user->submissions()->paginate(10);
        $types = $request->user_types;
        return view('user.submission.index')->with([
            "submissions" => $submissions,
            "types" => $types
        ]);
    }
    public function create(Request $request) {
        $typeId = $request->query("type", "");
        $type = JenisDocument::findOrFail($typeId);
        $specialTerms = $type->special_terms;
        return view('user.submission.new')->with([
            "type" => $type,
            "special_terms" => $specialTerms
        ]);
    }

    public function edit(Request $request, Submission $submission){
        $this->authorize("view", $submission);
        $details = $submission->details;
        return view("user.submission.edit")->with([
            "submission" => $submission,
            "details" => $details
        ]);
    }

    public function cancel(Submission $submission) {
        $submission->status = SubmissionStatuses::Cancelled->value;
        $submission->save();
        return redirect()->back()->with("error", "berhasil membatalkan pengajuan");
    }

    public function detail(Submission $submission) {
        $this->authorize("view", $submission);
        $details = $submission->details;
        return view("user.submission.detail")->with([
            "submission" => $submission,
            "details" => $details
        ]);
    }

    public function update(UpdateUserSubmissionRequest $request, Submission $submission){
        $this->authorize("update", $submission);
        $data = $request->validated();
        DB::beginTransaction();
        try {
            if($request->has("file")) {
                $submissionFile = $request->file("file")->store("/submissions/files");
                $data["file"] = $submissionFile;
            }
            if($submission->status === SubmissionStatuses::Revised->value) {
                $data["status"] = SubmissionStatuses::Pending->value;
            }
            $submission->update($data);
            $details = $submission->details;
            foreach($details as $detail) {
                $rule = "";
                if($detail->special_term->type === SpecialTermTypes::Image->value) {
                    $rule .= "|mimes:png,jpg,jpeg";
                }
                if($detail->special_term->type === SpecialTermTypes::File->value) {
                    $rule .= "|mimes:pdf";
                }
                if($detail->special_term->type === SpecialTermTypes::Text->value) {
                    $rule .= "min:5|max:255";    
                }
                $validatedTerm = $this->validate($request, [
                    (string)$detail->id => $rule
                ]);  
                $content = "";
                if($request->hasFile($detail->id) && ($detail->special_term->type === SpecialTermTypes::File->value || $detail->special_term->type === SpecialTermTypes::Image->value)) {
                    $content = $request->file($detail->id)->store("/submissions/terms");
                } else if($request->has($detail->id)) {
                    $content = $request->get($detail->id);
                } 

                if(!empty($content)){
                    $detail->content = $content;
                    $detail->save();
                }
            }
            DB::commit();
            return redirect()->route('user.submission.index')->with('success', "berhasil mengubah pengajuan dokumen");
        }catch(\Throwable $th) {
            DB::rollback();
            dd($th);
            return back()->with("error", "terjadi kesalahan dalam proses update pengajuan");
        }
    }

    public function store(StoreUserSubmissionRequest $request, JenisDocument $type) {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $user = $request->user();
            $data["user_id"] = $user->id;
            $data["jenis_document_id"] = $type->id;
            $specialTerms = $type->special_terms;
            $submissionFile = $request->file("file")->store("/submissions/files");
            $data["file"] = $submissionFile;
            $submission = Submission::create($data);
            foreach($specialTerms as $term) {
                if(!$request->has($term->id)) {
                    throw ValidationException::withMessages([
                        (string)$term->id => ['this field is required'],
                     ]);
                }
                $rule = "";
                if($term->type === SpecialTermTypes::Image->value) {
                    $rule .= "|mimes:png,jpg,jpeg";
                }
                if($term->type === SpecialTermTypes::File->value) {
                    $rule .= "|mimes:pdf";
                }
                if($term->type === SpecialTermTypes::Text->value) {
                    $rule .= "|max:255";    
                }
                $validatedTerm = $this->validate($request, [
                    (string)$term->id => $rule
                ]);                
                $content = "";
                if($term->type === SpecialTermTypes::File->value || $term->type === SpecialTermTypes::Image->value) {
                    $content = $request->file($term->id)->store("/submissions/terms");
                } else {
                    $content = $request->get($term->id);
                }
                SubmissionDetail::create([
                    "submission_id" => $submission->id,
                    "special_term_id" => $term->id,
                    "content" => $content
                ]);
            }
            DB::commit();
            return redirect()->route('user.submission.index')->with('success', "berhasil mengajukan dokumen");
        }catch(\Throwable $th) {
            DB::rollback();
            if(get_class($th) === "Illuminate\Validation\ValidationException") {
                return redirect()->back()->withErrors($th->errors());
            }
            return redirect()->back()->with("error", "terjadi kesalahan dalam proses pengajuan");
        }
    }
}
