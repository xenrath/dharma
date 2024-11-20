<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Luaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jenis_luaran_id',
        'tahun',
        'judul',
        'deskripsi',
        'url',
        'file',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jenis_luaran()
    {
        return $this->belongsTo(JenisLuaran::class);
    }

    public function luaran_personels()
    {
        return $this->hasMany(LuaranPersonel::class);
    }
}
