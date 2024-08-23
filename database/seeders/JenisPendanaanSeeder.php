<?php

namespace Database\Seeders;

use App\Models\JenisPendanaan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisPendanaanSeeder extends Seeder
{
    public function run(): void
    {
        $jenis_pendanaans = [
            [
                'nama' => 'Universitas Bhamada Slawi',
            ],
            [
                'nama' => 'Pemerintah',
            ],
            [
                'nama' => 'Mandiri',
            ],
            [
                'nama' => 'Perusahaan Swasta',
            ],
            [
                'nama' => 'Luar Negeri',
            ],
            [
                'nama' => 'Hibah Yayasan',
            ],
        ];

        JenisPendanaan::insert($jenis_pendanaans);
    }
}
