<?php

namespace App\Livewire\Penganggaran\SubKegiatanBelanja;

use App\Livewire\LivewireComponent;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class SubKegiatanBelanjaSkpdList extends LivewireComponent
{

    use WithPagination, Actions;

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.penganggaran.sub-kegiatan-belanja.sub-kegiatan-belanja-skpd-list');
    }
}
