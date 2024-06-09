<?php

namespace App\Livewire\Referensi\Rekening\Akun;

use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Livewire\Attributes\Layout;
use Livewire\Component;

class TabelAkun extends Component
{

    #[Layout('layouts.app')]
    public function render(Request $request)
    {
        $akuns = Akun::query()
            ->get();

        $data = [];
        $index = 0;

        foreach ($akuns as $key => $akun) {
            $data[$index] = [
                'kode' => $akun->kode,
                'nama' => $akun->nama,
            ];
            $index++;

            foreach ($akun->kelompoks as $key => $kelompok) {
                $data[$index] = [
                    'kode' => $kelompok->kode,
                    'nama' => $kelompok->nama,
                ];
                $index++;

                foreach ($kelompok->jenis as $key => $jns) {
                    $data[$index] = [
                        'kode' => $jns->kode,
                        'nama' => $jns->nama,
                    ];
                    $index++;
                }
            }
        }

        $currentPage = Paginator::resolveCurrentPage();
        $col = collect($data);
        $perPage = 10;
        $currentPageItems = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $items = new Paginator($currentPageItems, count($col), $perPage);
        $items->setPath($request->url());
        $items->appends($request->all());
        dd(array($items));

        return view('livewire.referensi.rekening.akun.tabel-akun');
    }
}
