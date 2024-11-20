<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tahun',
        'judul',
        'isbn',
        'jumlah',
        'penerbit',
        'file',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function buku_personels()
    {
        return $this->hasMany(BukuPersonel::class);
    }
}
