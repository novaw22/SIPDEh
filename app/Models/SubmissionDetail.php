<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionDetail extends Model
{
    use HasFactory;
    protected $guarded = ["id"];

    public function submission() {
        return $this->belongsTo(Submission::class);
    }

    public function special_term() {
        return $this->belongsTo(SpecialTerm::class);
    }
}
