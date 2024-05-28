<?php

namespace Database\Seeders;

use App\Models\Skpd;
use App\Models\UnitSkpd;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkpdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        require __DIR__ . '/data/skpd.php';
        $skpd = null;
        $unit = null;

        foreach ($dataSkpd as $key => $data) {
            // Create SKPD
            $kodeSkpd = str($data['skpd'])->substr(0, 22);
            $namaSkpd = str($data['skpd'])->substr(23);
            if (!empty($kodeSkpd)) {
                $skpd = Skpd::firstOrCreate(
                    ['kode' => $kodeSkpd],
                    ['nama' => $namaSkpd]
                );
            }

            // Create Unit
            $kodeUnit = str($data['unit_skpd'])->substr(0, 22);
            $namaUnit = str($data['unit_skpd'])->substr(23);
            if (!empty($kodeUnit)) {
                $unit = UnitSkpd::firstOrCreate(
                    ['kode' => $kodeUnit],
                    ['nama' => $namaUnit, 'skpd_id' => $skpd->id]
                );
            }
        }
    }
}
