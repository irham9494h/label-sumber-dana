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
            $newAkun = AkunRekening::firstOrCreate(
                ['kode' => $data['akun'], 'jenis_akun' => AkunRekening::AKUN],
                ['nama' => $data['uraian']]
            );

            $newKelompok = AkunRekening::firstOrCreate(
                ['kode' => $data['akun'] . '.' . $data['kelompok'], 'jenis_akun' => AkunRekening::KELOMPOK],
                ['nama' => $data['uraian']]
            );

            $newJenis = AkunRekening::firstOrCreate(
                [
                    'kode' => $data['akun'] . '.' . $data['kelompok'] . '.' . $data['jenis'],
                    'jenis_akun' => AkunRekening::JENIS
                ],
                ['nama' => $data['uraian']]
            );

            $newObjek = AkunRekening::firstOrCreate(
                [
                    'kode' => $data['akun'] . '.' . $data['kelompok'] . '.' . $data['jenis'] . '.' . $data['objek'],
                    'jenis_akun' => AkunRekening::OBJEK
                ],
                ['nama' => $data['uraian']]
            );

            $newRincianObjek = AkunRekening::firstOrCreate(
                [
                    'kode' => $data['akun'] . '.' . $data['kelompok'] . '.' . $data['jenis'] . '.' . $data['objek'] . '.' . $data['rincian_objek'],
                    'jenis_akun' => AkunRekening::RINCIAN_OBJEK
                ],
                ['nama' => $data['uraian']]
            );

            $newSubRincianObjek = AkunRekening::firstOrCreate(
                [
                    'kode' => $data['akun'] . '.' . $data['kelompok'] . '.' . $data['jenis'] . '.' . $data['objek'] . '.' . $data['rincian_objek'] . '.' . $data['sub_rincian_objek'],
                    'jenis_akun' => AkunRekening::SUB_RINCIAN_OBJEK
                ],
                ['nama' => $data['uraian']]
            );
        }
    }
}
