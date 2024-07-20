<?php

namespace App\Livewire\Penganggaran\SubKegiatanBelanja;

use App\Livewire\LivewireComponent;
use App\Models\RincianBelanja;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

class RincianBelanjaSubKegiatan extends LivewireComponent
{
    use WithPagination;

    public $belanjaId = null;

    public function mount($belanjaId)
    {
        $this->belanjaId = $belanjaId;
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $rincianBelanjas = RincianBelanja::query()
            ->with([
                'belanja',
                'sumberDana',
                'standarHarga',
                'akun',
            ])
            ->where('belanja_id', $this->belanjaId)
            ->paginate($this->perPage);

        return view('livewire.penganggaran.sub-kegiatan-belanja.rincian-belanja-sub-kegiatan', [
            'rincianBelanjas' => $rincianBelanjas
        ]);
    }
}
