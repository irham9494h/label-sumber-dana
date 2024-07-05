<?php

namespace App\Livewire\Penganggaran\SubKegiantanBelanja;

use App\Livewire\LivewireComponent;
use App\Models\Belanja;
use App\Models\JadwalPenganggaran;
use App\Models\RincianBelanja;
use App\Models\Skpd;
use App\Models\UnitSkpd;
use Illuminate\Cache\RateLimiting\Limit;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SubKegiatanBelanjaList extends LivewireComponent
{

    use WithPagination;

    public $tahun = '';

    public $jadwalPenganggarans = [];
    public $currentJadwalPenggaran = null;

    public function mount()
    {
        $this->tahun = Cache::get('tahun');

        $this->jadwalPenganggarans = JadwalPenganggaran::query()
            ->with('tahapan')
            ->where('tahun', $this->tahun)
            ->latest()
            ->get();

        if (count($this->jadwalPenganggarans) > 0) {
            $this->currentJadwalPenggaran = $this->jadwalPenganggarans[0];
        }
    }

    public function updatedSearchKeyword()
    {
        $this->resetPage();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $jadwalPenganggaranId = $this->currentJadwalPenggaran->id;
        $tahun = $this->tahun;

        $belanjaSkpds = Skpd::query()
            ->with([
                'belanjas' => function ($query) use ($jadwalPenganggaranId, $tahun) {
                    $query->whereHas('jadwalPenganggaran', function ($query) use ($jadwalPenganggaranId, $tahun) {
                        $query->where('id', $jadwalPenganggaranId)
                            ->where('tahun', $tahun);
                    });
                },
            ])
            ->orderBy('kode')
            ->paginate($this->perPage);

        $belanjaSkpdCascadings = [];

        foreach ($belanjaSkpds as $key => $value) {
            $belanjaIds = $value->belanjas->select('id')->pluck('id')->toArray();
            $sumHarga = RincianBelanja::whereIn('belanja_id', $belanjaIds)->get();

            array_push($belanjaSkpdCascadings, [
                'skpd' => $value,
                'total_sub_kegiatan' => count($belanjaIds),
                'total_murni' => $sumHarga->sum('total_harga_murni'),
                'total_perubahan' => $sumHarga->sum('total_harga'),
                'realisasi' => 0
            ]);
        }

        return view('livewire.penganggaran.sub-kegiantan-belanja.sub-kegiatan-belanja-list', [
            'belanjaSkpds' => $belanjaSkpds,
            'belanjaSkpdCascadings' => $belanjaSkpdCascadings
        ]);
    }
}
