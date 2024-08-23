<?php

namespace Database\Seeders;

use App\Models\Prodi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    public function run(): void
    {
        $prodis = [
            // 1
            [
                'nama' => 'Profesi Ners',
                'fakultas_id' => '1',
            ],
            // 2
            [
                'nama' => 'S1 Ilmu Keperawatan',
                'fakultas_id' => '1',
            ],
            // 3
            [
                'nama' => 'S1 Farmasi',
                'fakultas_id' => '1',
            ],
            // 4
            [
                'nama' => 'D4 Keselamatan dan Kesehatan Kerja',
                'fakultas_id' => '1',
            ],
            // 5
            [
                'nama' => 'D3 Kebidanan',
                'fakultas_id' => '1',
            ],
            // 6
            [
                'nama' => 'D3 Keperawatan',
                'fakultas_id' => '1',
            ],
            // 7
            [
                'nama' => 'S1 Bisnis Digital',
                'fakultas_id' => '2',
            ],
            // 8
            [
                'nama' => 'S1 Kewirausahaan',
                'fakultas_id' => '2',
            ],
            // 9
            [
                'nama' => 'S1 Informatika',
                'fakultas_id' => '3',
            ],
        ];

        Prodi::insert($prodis);
    }
}
