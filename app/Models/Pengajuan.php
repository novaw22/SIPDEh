<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengajuan extends Model
{
    use HasFactory, SoftDeletes;

    public function jenisDokumen() {
        return $this->belongsTo(JenisDokumen::class);
    }

    public function details() {
        return $this->hasMany(DetailPengajuan::class);
    }
}
