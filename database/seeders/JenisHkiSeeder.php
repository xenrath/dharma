<?php

namespace Database\Seeders;

use App\Models\JenisHki;
use Illuminate\Database\Seeder;

class JenisHkiSeeder extends Seeder
{
    public function run(): void
    {
        $jenis_hkis = [
            [
                'nama' => 'Paten'
            ],
            [
                'nama' => 'Paten Sederhana'
            ],
            [
                'nama' => 'Hak Cipta'
            ],
            [
                'nama' => 'Merek Dagang'
            ],
            [
                'nama' => 'Rahasia Dagang'
            ],
            [
                'nama' => 'Desain Produk Industri'
            ],
            [
                'nama' => 'Perlindungan Varietas Tanaman'
            ],
            [
                'nama' => 'Perlindungan Topografi Sirkuit Terpadu'
            ],
        ];
        // 
        JenisHki::insert($jenis_hkis);
    }
}
