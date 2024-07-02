<?php

namespace Database\Seeders;

use App\Models\AkunRekening;
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

        foreach ($dataAkun as $key => $data) {

            $kode_akun = "";
            $jenis_akun = "";

            if ($data['akun'] && $data['kelompok'] && $data['jenis'] && $data['objek'] && $data['rincian_objek'] && $data['sub_rincian_objek']) {
                $kode_akun = $data['akun'] . '.' . $data['kelompok'] . '.' . $data['jenis'] . '.' . $data['objek'] . '.' . $data['rincian_objek'] . '.' . $data['sub_rincian_objek'];
                $jenis_akun = AkunRekening::SUB_RINCIAN_OBJEK;
            } else if ($data['akun'] && $data['kelompok'] && $data['jenis'] && $data['objek'] && $data['rincian_objek'] && !$data['sub_rincian_objek']) {
                $kode_akun = $data['akun'] . '.' . $data['kelompok'] . '.' . $data['jenis'] . '.' . $data['objek'] . '.' . $data['rincian_objek'];
                $jenis_akun = AkunRekening::RINCIAN_OBJEK;
            } else if ($data['akun'] && $data['kelompok'] && $data['jenis'] && $data['objek'] && !$data['rincian_objek'] && !$data['sub_rincian_objek']) {
                $kode_akun = $data['akun'] . '.' . $data['kelompok'] . '.' . $data['jenis'] . '.' . $data['objek'];
                $jenis_akun = AkunRekening::OBJEK;
            } else if ($data['akun'] && $data['kelompok'] && $data['jenis'] && !$data['objek'] && !$data['rincian_objek'] && !$data['sub_rincian_objek']) {
                $kode_akun = $data['akun'] . '.' . $data['kelompok'] . '.' . $data['jenis'];
                $jenis_akun = AkunRekening::JENIS;
            } else if ($data['akun'] && $data['kelompok'] && !$data['jenis'] && !$data['objek'] && !$data['rincian_objek'] && !$data['sub_rincian_objek']) {
                $kode_akun = $data['akun'] . '.' . $data['kelompok'];
                $jenis_akun = AkunRekening::KELOMPOK;
            } else if ($data['akun'] && !$data['kelompok'] && !$data['jenis'] && !$data['objek'] && !$data['rincian_objek'] && !$data['sub_rincian_objek']) {
                $kode_akun = $data['akun'];
                $jenis_akun = AkunRekening::AKUN;
            }

            $newAkun = AkunRekening::firstOrCreate(
                ['kode' => $kode_akun, 'jenis_akun' => $jenis_akun],
                ['nama' => $data['uraian']]
            );
        }
    }
}
