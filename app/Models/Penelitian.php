<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penelitian extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tahun',
        'judul',
        'jenis_penelitian_id',
        'jenis_pendanaan_id',
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

    public function jenis_penelitian()
    {
        return $this->belongsTo(JenisPenelitian::class);
    }

    public function personels()
    {
        return $this->hasMany(PenelitianPersonel::class);
    }

    public function penelitian_revisis()
    {
        return $this->hasMany(PenelitianRevisi::class);
    }
}
