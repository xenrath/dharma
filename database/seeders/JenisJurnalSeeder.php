<?php

namespace Database\Seeders;

use App\Models\JenisJurnal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisJurnalSeeder extends Seeder
{
    public function run(): void
    {
        $jenis_jurnals = [
            [
                'nama' => 'Internasional',
            ],
            [
                'nama' => 'Nasional Terakreditasi',
            ],
            [
                'nama' => 'Nasional Tidak Terakreditasi (Mempunyai ISSN)',
            ],
        ];
        // 
        JenisJurnal::insert($jenis_jurnals);
    }
}
