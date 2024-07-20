<?php

namespace App\Livewire\Penganggaran\SubKegiatanBelanja;

use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class SubKegiatanInfo extends Component
{
    public $showInfoDialog = false;

    public $belanja = null;
    public $jadwalPenggaran = null;

    public $tahun = '';

    public $rincianBelanja = [];

    public function mount($data, $jadwalPenggaran)
    {
        $this->tahun = Cache::get('tahun');
        $this->belanja = $data;
        $this->jadwalPenggaran = $jadwalPenggaran;
    }

    public function render()
    {
        return view('livewire.penganggaran.sub-kegiatan-belanja.sub-kegiatan-info');
    }
}
