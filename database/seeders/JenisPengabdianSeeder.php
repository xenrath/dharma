<?php

namespace Database\Seeders;

use App\Models\JenisPengabdian;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisPengabdianSeeder extends Seeder
{
    public function run(): void
    {
        $jenis_pengabdians = [
            [
                'nama' => 'IPTEK bagi Masyarakat',
            ],
            [
                'nama' => 'IPTEK bagi Kewirausahaan',
            ],
        ];

        JenisPengabdian::insert($jenis_pengabdians);
    }
}
