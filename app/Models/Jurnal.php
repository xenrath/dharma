<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jenis_jurnal_id',
        'tahun',
        'nama',
        'judul',
        'issn',
        'volume',
        'nomor',
        'halaman_awal',
        'halaman_akhir',
        'url',
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

    public function jurnal_personels()
    {
        return $this->hasMany(JurnalPersonel::class);
    }
}
