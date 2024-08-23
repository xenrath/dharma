<?php

namespace Database\Seeders;

use App\Models\JenisPenelitian;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisPenelitianSeeder extends Seeder
{
    public function run(): void
    {
        $jenis_penelitians = [
            [
                'nama' => 'Fundamental',
            ],
            [
                'nama' => 'Dosen Pemula',
            ],
            [
                'nama' => 'Produk Terapan',
            ],
            [
                'nama' => 'Sosial, Humaniora dan Pendidikan',
            ],
            [
                'nama' => 'Unggulan Perguruan Tinggi',
            ],
            [
                'nama' => 'Search and Share Grant',
            ],
            [
                'nama' => 'Kerjasama',
            ],
        ];

        JenisPenelitian::insert($jenis_penelitians);
    }
}
