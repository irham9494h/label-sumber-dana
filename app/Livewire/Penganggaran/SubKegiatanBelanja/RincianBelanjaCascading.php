<?php

namespace App\Livewire\Penganggaran\SubKegiatanBelanja;

use App\Models\Belanja;
use App\Models\SubKegiatan;
use App\Models\UnitSkpd;
use Livewire\Component;

class RincianBelanjaCascading extends Component
{
    public $belanja = null;
    public $belanjaId = null;

    public function mount($belanjaId)
    {
        $this->belanjaId = $belanjaId;
        $this->belanja = Belanja::findOrFail($belanjaId);
    }

    public function render()
    {
        $subKegiatan = SubKegiatan::query()
            ->with([
                'kegiatan.program.bidangUrusan'
            ])
            ->where('id', $this->belanja->sub_kegiatan_id)
            ->first();

        $unitSkpd = UnitSkpd::query()
            ->with('skpd')
            ->where('id', $this->belanja->unit_skpd_id)->first();

        return view('livewire.penganggaran.sub-kegiatan-belanja.rincian-belanja-cascading', [
            'subKegiatan' => $subKegiatan,
            'unitSkpd' => $unitSkpd
        ]);
    }
}
