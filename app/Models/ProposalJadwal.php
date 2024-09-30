<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalJadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'nomor',
        'perihal',
        'kepadas',
        'proposal_ids'
    ];

    protected $casts = [
        'kepadas' => 'array',
        'proposal_ids' => 'array',
    ];
}
