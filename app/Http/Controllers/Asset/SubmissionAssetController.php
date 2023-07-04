<?php

namespace App\Http\Controllers\Asset;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Submission;
use App\Models\SubmissionDetail;
use Illuminate\Support\Facades\Storage;

class SubmissionAssetController extends Controller
{
    public function file(Submission $submission) {
        $this->authorize("view", $submission);
        $path = $submission->file;
        try {
            return response()->file(
                Storage::path($path)
            );
        }catch(\Throwable $th) {
            abort(404);
        }
    }
    public function detail(SubmissionDetail $submissionDetail) {
        $this->authorize("view", $submissionDetail);
        $path = $submissionDetail->content;
        try {
            return response()->file(
                Storage::path($path)
            );
        }catch(\Throwable $th) {
            abort(404);
        }
    }
}
