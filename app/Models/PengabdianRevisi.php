<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengabdianRevisi extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengabdian_id',
        'keterangan',
        'file',
    ];

    public function pengabdian()
    {
        return $this->belongsTo(Pengabdian::class);
    }
}
