<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisDocumentUser extends Model
{
    use HasFactory;
    protected $guarded = ["id"];

    public function jenisDocument() {
        return $this->belongsTo(JenisDocument::class);
    }
}
