<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis',
        'user_id',
        'tahun',
        'judul',
        'jenis_pendanaan_id',
        'jenis_penelitian_id',
        'jenis_pengabdian_id',
        'dana_sumber',
        'dana_usulan',
        'dana_setuju',
        'berkas',
        'tanggal',
        'jam',
        'peninjau_id',
        'jadwal_id',
        'status',
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

    public function jenis_pengabdian()
    {
        return $this->belongsTo(JenisPengabdian::class);
    }

    public function personels()
    {
        return $this->hasMany(ProposalPersonel::class);
    }

    public function peninjau()
    {
        return $this->belongsTo(User::class);
    }

    public function proposal_revisis()
    {
        return $this->hasMany(ProposalRevisi::class);
    }
}
