<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengabdianPersonel extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengabdian_id',
        'user_id',
    ];

    public function pengabdian()
    {
        return $this->belongsTo(Pengabdian::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
