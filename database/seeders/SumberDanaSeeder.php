<?php

namespace Database\Seeders;

use App\Models\SumberDana;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SumberDanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        require __DIR__ . '/data/sumber-dana.php';

        foreach ($dataSumberDaba as $key => $data) {
            $setInput = true;

            if ($data['set_input'] == 'TIDAK')
                $setInput = false;

            SumberDana::create([
                'kode' => $data['kode'],
                'nama' => Str::after($data['sumber_dana'], '-'),
                'jenis' => Str::before($data['sumber_dana'], '-'),
                'set_input' => $setInput
            ]);
        }
    }
}
