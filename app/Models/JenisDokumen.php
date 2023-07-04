<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisDokumen extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name'
    ];

    public function pengajuans() {
        return $this->hasMany(Pengajuan::class);
    }

    public function syarats() {
        return $this->hasMany(SyaratPengajuan::class);
    }
}
