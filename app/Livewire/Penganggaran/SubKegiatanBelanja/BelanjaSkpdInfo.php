<?php

namespace App\Livewire\Penganggaran\SubKegiatanBelanja;

use App\Models\RincianBelanja;
use App\Models\Skpd;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class BelanjaSkpdInfo extends Component
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

        // $this->rincianBelanja = Skpd::with('rincianBelanjas')
        //     ->where('id', $data['skpd']->id)
        //     ->get();
    }

    public function render()
    {
        return view('livewire.penganggaran.sub-kegiatan-belanja.belanja-skpd-info');
    }
}
