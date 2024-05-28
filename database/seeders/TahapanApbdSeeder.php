<?php

namespace Database\Seeders;

use App\Models\TahapanApbd;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TahapanApbdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TahapanApbd::create([
            'tahun' => 2024,
            'nama' => 'APBD Murni',
            'nomor_dpa' => '-',
            'is_current' => false,
        ]);

        TahapanApbd::create([
            'tahun' => 2024,
            'nama' => 'Perubahan 1',
            'nomor_dpa' => '-',
            'is_current' => false,
        ]);

        TahapanApbd::create([
            'tahun' => 2024,
            'nama' => 'Perubahan 2',
            'nomor_dpa' => '-',
            'is_current' => true,
        ]);
    }
}
