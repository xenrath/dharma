<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'nama',
        'username',
        'password',
        'nidn',
        'nipy',
        'fakultas_id',
        'prodi_id',
        'telp',
        'is_ketua',
        'is_peninjau',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function isDev()
    {
        if ($this->role == 'dev') {
            return true;
        } else {
            return false;
        }
    }

    public function isOperator()
    {
        if ($this->role == 'operator') {
            return true;
        } else {
            return false;
        }
    }

    public function isDosen()
    {
        if ($this->role == 'dosen') {
            return true;
        } else {
            return false;
        }
    }

    public function isKetua()
    {
        return $this->is_ketua;
    }

    public function isPeninjau()
    {
        return $this->is_peninjau;
    }
}
