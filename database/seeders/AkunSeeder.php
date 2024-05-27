<?php

namespace Database\Seeders;

use App\Models\Akun;
use App\Models\Jenis;
use App\Models\Kelompok;
use App\Models\Objek;
use App\Models\RincianObjek;
use App\Models\SubRincianObjek;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        require __DIR__ . '/data/akun.php';
        $akun = null;
        $kelompok = null;
        $jenis = null;
        $objek = null;
        $rincian_objek = null;
        $sub_rincian_objek = null;

        foreach ($dataAkun as $key => $data) {
            // Create Akun
            if (!empty($data['akun'])) {
                $akun = Akun::firstOrCreate(
                    ['kode' => $data['akun']],
                    ['nama' => $data['uraian']]
                );
            }

            // Create Kelompok
            if (!empty($data['kelompok'])) {
                $kelompok = Kelompok::firstOrCreate(
                    ['kode' => $data['akun'] . '.' . $data['kelompok']],
                    ['nama' => $data['uraian'], 'akun_id' => $akun->id]
                );
            }

            // Create Jenis
            if (!empty($data['jenis'])) {
                $jenis = Jenis::firstOrCreate(
                    ['kode' => $data['akun'] . '.' . $data['kelompok'] . '.' . $data['jenis']],
                    ['nama' => $data['uraian'], 'kelompok_id' => $kelompok->id]
                );
            }

            // Create Objek
            if (!empty($data['objek'])) {
                $objek = Objek::firstOrCreate(
                    ['kode' => $data['akun'] . '.' . $data['kelompok'] . '.' . $data['jenis'] . '.' . $data['objek']],
                    ['nama' => $data['uraian'], 'jenis_id' => $jenis->id]
                );
            }

            // Create Rincian Objek
            if (!empty($data['rincian_objek'])) {
                $rincian_objek = RincianObjek::firstOrCreate(
                    ['kode' => $data['akun'] . '.' . $data['kelompok'] . '.' . $data['jenis'] . '.' . $data['objek'] . '.' . $data['rincian_objek']],
                    ['nama' => $data['uraian'], 'objek_id' => $objek->id]
                );
            }


            // Create Rincian Objek
            if (!empty($data['sub_rincian_objek'])) {
                $sub_rincian_objek = SubRincianObjek::firstOrCreate(
                    ['kode' => $data['akun'] . '.' . $data['kelompok'] . '.' . $data['jenis'] . '.' . $data['objek'] . '.' . $data['rincian_objek'] . '.' . $data['sub_rincian_objek']],
                    ['nama' => $data['uraian'], 'rincian_objek_id' => $rincian_objek->id]
                );
            }
        }
    }
}
