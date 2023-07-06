<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSubmissionRequest;
use App\Http\Requests\UpdateSubmissionRequest;
use App\Enums\SubmissionStatuses;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize("viewAny", Submission::class);
        $keyword = $request->query("q", "");
        $status = $request->query("status", "");
        $q = Submission::where("status", "!=", SubmissionStatuses::Cancelled->value)
            ->where(function ($q) use($keyword) {
                return $q->whereHas("jenis_document",function ($query) use ($keyword) {
                    return $query->where("name", "LIKE", "%{$keyword}%");
                })
                ->orWhere("id", $keyword);
            });
        if($status != ""){
            $q->where("status", $status);
        }
        $submissions = $q
            ->orderBy("updated_at", "desc")
            ->paginate(5)
            ->withQueryString();
        return view('admin.submissions.index')->with([
            "submissions" => $submissions,
            "queryStatus" => $status
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Submission $submission)
    {
        $this->authorize("view", $submission);
        return view("admin.submissions.review")->with("submission", $submission);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubmissionRequest $request, Submission $submission)
    {
        $this->authorize("update", $submission);
        $data = $request->validated();
        $this->authorize("update", $submission);
        if($submission->status === SubmissionStatuses::Cancelled->value) {
            return redirect()->route('admin.submissions.index')->with("error", "tidak bisa update pengajuan karena pengajuan dibatalkan");
        }
        if ($data === SubmissionStatuses::Cancelled->value || $data === SubmissionStatuses::Pending->value){
            unset($data["status"]);
        }
        if($request->hasFile("soft_copy")){
            $path = $request->file("soft_copy")->store("/submissions/soft_copy");
            $data["soft_copy"] = $path;
        }
        $submission->update($data);
        return redirect()->route('admin.submissions.index')->with("success", "berhasil mengubah status pengajuan");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Submission $submission)
    {
        //
    }
}
