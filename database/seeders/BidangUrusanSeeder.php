<?php

namespace Database\Seeders;

use App\Models\BidangUrusan;
use App\Models\BidangUrusanUnitSkpd;
use App\Models\UnitSkpd;
use App\Models\Urusan;
use Illuminate\Database\Seeder;

class BidangUrusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        require __DIR__ . '/data/bidang-urusan.php';
        $urusan = null;
        $bidang_urusan = null;

        foreach ($bidangUrusans as $key => $data) {
            // Create Urusan
            if (!empty($data['kode_urusan'])) {
                $urusan = Urusan::firstOrCreate(
                    ['kode' => $data['kode_urusan']],
                    ['nama' => $data['urusan']]
                );
            }

            // Create Bidang Urusan
            if (!empty($data['kode_bidang_urusan'])) {
                $bidang_urusan = BidangUrusan::firstOrCreate(
                    ['urusan_id' => $urusan->id, 'kode' => $data['kode_bidang_urusan']],
                    ['nama' => $data['bidang_urusan']]
                );
            }
        }

        $unitSkpds = UnitSkpd::get();

        foreach ($unitSkpds as $key => $unit) {
            $bidang_urusan_id = BidangUrusan::query()
                ->where('kode', substr($unit->kode, 0, 4))
                ->pluck('id')
                ->first();

            BidangUrusanUnitSkpd::create([
                'bidang_urusan_id' => $bidang_urusan_id,
                'unit_skpd_id' => $unit->id
            ]);
        }
    }
}
