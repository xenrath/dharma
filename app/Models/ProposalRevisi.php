<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalRevisi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'proposal_id',
        'keterangan',
        'file',
        'status',
        'is_aktif',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }
}
