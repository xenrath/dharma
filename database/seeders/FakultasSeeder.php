<?php

namespace Database\Seeders;

use App\Models\Fakultas;
use Illuminate\Database\Seeder;

class FakultasSeeder extends Seeder
{
    public function run(): void
    {
        $fakultass = [
            [
                'kode' => 'FIKES',
                'nama' => 'Fakultas Ilmu Kesehatan',
            ],
            [
                'kode' => 'FEB',
                'nama' => 'Fakultas Ekonomi Bisnis',
            ],
            [
                'kode' => 'FIKOM',
                'nama' => 'Fakultas Ilmu Komputer',
            ],
        ];

        Fakultas::insert($fakultass);
    }
}
