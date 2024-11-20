<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HkiPersonel extends Model
{
    use HasFactory;

    protected $fillable = [
        'hki_id',
        'user_id',
    ];

    public function hki()
    {
        return $this->belongsTo(Hki::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
