<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SyaratPengajuan extends Model
{
    use HasFactory, SoftDeletes;

    public function jenisDokumen() {
        return $this->belongsTo(JenisDokumen::class);
    }

    public function detailPengajuans() {
        return $this->hasMany(DetailPengajuan::class);
    }
}
