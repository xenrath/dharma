<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenelitianRevisi extends Model
{
    use HasFactory;

    protected $fillable = [
        'penelitian_id',
        'keterangan',
        'file',
    ];

    public function penelitian()
    {
        return $this->belongsTo(Penelitian::class);
    }
}
