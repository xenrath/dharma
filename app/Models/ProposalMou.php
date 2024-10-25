<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalMou extends Model
{
    use HasFactory;

    protected $fillable = [
        'proposal_id',
        'nomor',
        'tanggal',
        'draft',
        'file',
    ];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }
}
