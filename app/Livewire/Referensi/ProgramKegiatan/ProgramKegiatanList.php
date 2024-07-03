<?php

namespace App\Livewire\Referensi\ProgramKegiatan;

use App\Livewire\LivewireComponent;
use App\Models\Kegiatan;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class ProgramKegiatanList extends LivewireComponent
{
    use WithPagination;

    public $urusanId = null;

    public function updatedSearchKeyword()
    {
        $this->resetPage();
    }

    public function updatedUrusanId()
    {
        $this->resetPage();
    }

    #[Layout('layouts.app')]
    public function render()
    {

        $kegiatans = Kegiatan::query()
            ->search($this->searchKeyword)
            ->orderBy('kode')
            ->paginate($this->perPage);

        dd($kegiatans);

        return view('livewire.referensi.program-kegiatan.program-kegiatan-list');
    }
}
