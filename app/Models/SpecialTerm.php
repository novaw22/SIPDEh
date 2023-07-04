<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialTerm extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    
    public function jenis_document(){
        return $this->belongsTo(JenisDocument::class);
    }
}
