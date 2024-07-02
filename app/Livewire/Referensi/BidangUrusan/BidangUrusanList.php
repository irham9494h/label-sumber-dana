<?php

namespace App\Livewire\Referensi\BidangUrusan;

use App\Livewire\LivewireComponent;
use App\Models\BidangUrusan;
use App\Models\Urusan;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

class BidangUrusanList extends LivewireComponent
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
        $bidangUrusans = BidangUrusan::query()
            ->with('urusan')
            ->search($this->searchKeyword, $this->urusanId)
            ->orderBy('kode')
            ->paginate($this->perPage);

        $urusans = Urusan::orderBy('kode')->get();

        return view('livewire.referensi.bidang-urusan.bidang-urusan-list', [
            'urusans' => $urusans,
            'bidangUrusans' => $bidangUrusans
        ]);
    }
}
