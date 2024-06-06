<?php

namespace App\Livewire\SumberDana;

use App\Models\JadwalPenganggaran;
use App\Models\Skpd;
use App\Models\UnitSkpd;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class ImportData extends Component
{
    use Actions;
    use WithPagination;

    public $jadwalPenganggaranId = '';
    public $skpdId = '';
    public $unitSkpdId = '';
    public $file = '';

    public $jadwalPenganggarans = [];
    public $skpds = [];
    public $unitSkpds = [];

    public function mount()
    {
        $this->jadwalPenganggarans = $this->fetchJadwalPenganggaran();
        $this->skpds = $this->fetchSkpd();
    }

    public function updatedSkpdId()
    {
        $this->unitSkpds = $this->fetchUnitSkpd($this->skpdId);
    }

    public function fetchJadwalPenganggaran()
    {
        return JadwalPenganggaran::query()
            ->where('tahun', cache()->get('tahun'))
            ->latest()
            ->get();
    }

    public function fetchSkpd()
    {
        return Skpd::query()
            ->orderBy('kode')
            ->get();
    }

    public function fetchUnitSkpd($skpdId)
    {
        return UnitSkpd::query()
            ->where('skpd_id', $skpdId)
            ->get();
    }

    public function import()
    {
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.sumber-dana.import-data');
    }
}
