<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MakalahPersonel extends Model
{
    use HasFactory;

    protected $fillable = [
        'makalah_id',
        'user_id',
    ];

    public function makalah()
    {
        return $this->belongsTo(Makalah::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
