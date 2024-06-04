<?php

namespace Database\Seeders;

use App\Models\Tahapan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TahapanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tahapans = [
            [
                "id_tahap" => 2,
                "nama_tahap" => "KUA dan PPAS",
                "disable" => true
            ],
            [
                "id_tahap" => 40,
                "nama_tahap" => "Penetapan KUA-PPAS",
                "disable" => true
            ],
            [
                "id_tahap" => 5,
                "nama_tahap" => "RAPBD",
                "disable" => true
            ],
            [
                "id_tahap" => 27,
                "nama_tahap" => "Penyesuaian Hasil Evaluasi RAPBD",
                "disable" => true
            ],
            [
                "id_tahap" => 28,
                "nama_tahap" => "Penetapan APBD",
                "disable" => true
            ],
            [
                "id_tahap" => 7,
                "nama_tahap" => "APBD Pergeseran",
                "disable" => true
            ],
            [
                "id_tahap" => 30,
                "nama_tahap" => "Penetapan APBD Pergeseran",
                "disable" => true
            ],
            [
                "id_tahap" => 4,
                "nama_tahap" => "KUPA dan PPAS",
                "disable" => false
            ],
            [
                "id_tahap" => 41,
                "nama_tahap" => "Penetapan KUPA-PPAS",
                "disable" => true
            ],
            [
                "id_tahap" => 8,
                "nama_tahap" => "RAPBD Perubahan",
                "disable" => true
            ],
            [
                "id_tahap" => 25,
                "nama_tahap" => "Penyesuaian Hasil Evaluasi RAPBD Perubahan",
                "disable" => true
            ],
            [
                "id_tahap" => 29,
                "nama_tahap" => "Penetapan APBD Perubahan",
                "disable" => true
            ],
            [
                "id_tahap" => 31,
                "nama_tahap" => "APBD Pergeseran Setelah APBD Perubahan",
                "disable" => true
            ],
            [
                "id_tahap" => 32,
                "nama_tahap" => "Penetapan APBD Pergeseran Setelah APBD Perubahan",
                "disable" => true
            ]
        ];

        foreach ($tahapans as $key => $tahapan) {
            Tahapan::create([
                'id' => $tahapan['id_tahap'],
                'nama' => $tahapan['nama_tahap']
            ]);
        }
    }
}
