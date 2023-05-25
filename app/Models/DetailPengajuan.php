<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailPengajuan extends Model
{
    use HasFactory, SoftDeletes;

    public function pengajuan() {
        return $this->belongsTo(Pengajuan::class);
    }
    public function syarat() {
        return $this->belongsTo(SyaratPengajuan::class);
    }
}
