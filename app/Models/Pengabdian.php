<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengabdian extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tahun',
        'judul',
        'jenis_pengabdian_id',
        'jenis_pendanaan_id',
        'dana_sumber',
        'dana_setuju',
        'file',
        'mahasiswas',
        'status',
    ];

    protected $casts = [
        'mahasiswas' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jenis_pendanaan()
    {
        return $this->belongsTo(JenisPendanaan::class);
    }

    public function jenis_pengabdian()
    {
        return $this->belongsTo(JenisPengabdian::class);
    }

    public function personels()
    {
        return $this->hasMany(PengabdianPersonel::class);
    }

    public function pengabdian_revisis()
    {
        return $this->hasMany(PengabdianRevisi::class);
    }
}
