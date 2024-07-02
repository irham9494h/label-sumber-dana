<?php

namespace App\Livewire\Skpd;

use App\Livewire\LivewireComponent;
use App\Models\Skpd;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

class SkpdList extends LivewireComponent
{
    use WithPagination;

    public function updatedSearchKeyword()
    {
        $this->resetPage();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $skpds = Skpd::query()
            ->search($this->searchKeyword)
            ->orderBy('kode')
            ->paginate($this->perPage);

        return view('livewire.skpd.skpd-list', [
            'skpds' => $skpds
        ]);
    }
}
