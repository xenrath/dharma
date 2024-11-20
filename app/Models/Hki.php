<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hki extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jenis_hki_id',
        'nomor',
        'judul',
        'tahun',
        'pendaftaran',
        'status',
        'file',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jenis_hki()
    {
        return $this->belongsTo(JenisHki::class);
    }

    public function hki_personels()
    {
        return $this->hasMany(HkiPersonel::class);
    }
}
