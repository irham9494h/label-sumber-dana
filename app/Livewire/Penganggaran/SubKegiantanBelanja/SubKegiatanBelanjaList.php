<?php

namespace App\Livewire\Penganggaran\SubKegiantanBelanja;

use Livewire\Attributes\Layout;
use Livewire\Component;

class SubKegiatanBelanjaList extends Component
{
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.penganggaran.sub-kegiantan-belanja.sub-kegiatan-belanja-list');
    }
}
