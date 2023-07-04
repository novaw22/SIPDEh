<?php

namespace App\Http\Controllers\Asset;

use App\Traits\GetAsset;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Submission;
use App\Models\SubmissionDetail;
use Illuminate\Support\Facades\Storage;

class SubmissionAssetController extends Controller
{
    use GetAsset;

    public function file(Submission $submission) {
        $this->authorize("view", $submission);
        $path = $submission->file;
        return $this->getAsset($path);
    }
    public function softCopy(Submission $submission) {
        $this->authorize("view", $submission);
        $path = $submission->soft_copy;
        return $this->getAsset($path);
    }
    public function detail(SubmissionDetail $submissionDetail) {
        $this->authorize("view", $submissionDetail);
        $path = $submissionDetail->content;
        return $this->getAsset($path);
    }
}
