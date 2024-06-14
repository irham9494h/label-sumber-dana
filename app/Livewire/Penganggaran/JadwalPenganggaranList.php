<?php

namespace App\Livewire\Penganggaran;

use App\Livewire\LivewireComponent;
use App\Models\JadwalPenganggaran;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Layout;

use function Laravel\Prompts\select;

class JadwalPenganggaranList extends LivewireComponent
{
    public $tahun;
    public $showDetailModal = false;
    public $searchKeyword = '';
    public $selectedJadwal = null;

    public function mount()
    {
        $this->tahun = Cache::get('tahun');
    }

    public function setSelectedJadwal(JadwalPenganggaran $jadwalPenganggaran)
    {
        $this->selectedJadwal = $jadwalPenganggaran;
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $jadwalPenganggarans = JadwalPenganggaran::query()
            ->search($this->searchKeyword)
            ->where('tahun', $this->tahun)
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.penganggaran.jadwal-penganggaran-list', [
            'jadwalPenganggarans' => $jadwalPenganggarans
        ]);
    }
}
