<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Makalah extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tingkat',
        'tahun',
        'judul',
        'forum',
        'institusi',
        'tanggal_awal',
        'tanggal_akhir',
        'tempat',
        'file',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function makalah_personels()
    {
        return $this->hasMany(MakalahPersonel::class);
    }
}
