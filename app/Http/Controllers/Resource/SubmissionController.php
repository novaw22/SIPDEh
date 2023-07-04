<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSubmissionRequest;
use App\Http\Requests\UpdateSubmissionRequest;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->query("q", "");
        $status = $request->query("status", "");
        $q = Submission::whereHas("jenis_document",function ($query) use ($keyword) {
                return $query->where("name", "LIKE", "%{$keyword}%");
            });
        if($status != ""){
            $q->where("status", $status);
        }
        $submissions = $q->paginate(5)->withQueryString();
        return view('admin.submissions.index')->with("submissions", $submissions);
    }

    /**
     * Display the specified resource.
     */
    public function show(Submission $submission)
    {
        return view("admin.submissions.review")->with("submission", $submission);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubmissionRequest $request, Submission $submission)
    {
        $data = $request->validated();
        $submission->update($data);
        return redirect()->route('admin.submissions.index', ["status"=>\App\Enums\SubmissionStatuses::Pending->value])->with("success", "berhasil mengubah status pengajuan");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Submission $submission)
    {
        //
    }
}
