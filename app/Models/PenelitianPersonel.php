<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenelitianPersonel extends Model
{
    use HasFactory;

    protected $fillable = [
        'penelitian_id',
        'user_id',
    ];

    public function penelitian()
    {
        return $this->belongsTo(Penelitian::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
