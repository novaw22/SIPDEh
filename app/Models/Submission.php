<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;
    protected $guarded = ["id"];

    public function details() {
        return $this->hasMany(SubmissionDetail::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function jenis_document() {
        return $this->belongsTo(JenisDocument::class);
    }
}
