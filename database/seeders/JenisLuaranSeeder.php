<?php

namespace Database\Seeders;

use App\Models\JenisLuaran;
use Illuminate\Database\Seeder;

class JenisLuaranSeeder extends Seeder
{
    public function run(): void
    {
        $jenis_luarans = [
            [
                'nama' => 'Desain',
            ],
            [
                'nama' => 'Karya Seni',
            ],
            [
                'nama' => 'Kebijakan',
            ],
            [
                'nama' => 'Media Massa Nasional',
            ],
            [
                'nama' => 'Media Massa Internasional',
            ],
            [
                'nama' => 'Model',
            ],
            [
                'nama' => 'Prototype',
            ],
            [
                'nama' => 'Rekayasa Sosial',
            ],
            [
                'nama' => 'Teknologi Tepat Guna (TTG)',
            ],
        ];

        JenisLuaran::insert($jenis_luarans);
    }
}
