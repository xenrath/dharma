<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LuaranPersonel extends Model
{
    use HasFactory;

    protected $fillable = [
        'luaran_id',
        'user_id',
    ];

    public function luaran()
    {
        return $this->belongsTo(Luaran::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
