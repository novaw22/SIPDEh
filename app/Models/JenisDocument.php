<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisDocument extends Model
{
    use HasFactory;
    protected $guarded = ["id"];

    public function submissions() {
        return $this->hasMany(Submission::class);
    }
}
