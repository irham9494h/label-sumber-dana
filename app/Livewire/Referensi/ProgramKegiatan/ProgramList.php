<?php

namespace App\Livewire\Referensi\ProgramKegiatan;

use App\Livewire\LivewireComponent;
use App\Models\BidangUrusan;
use App\Models\Program;
use App\Models\Urusan;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

class ProgramList extends LivewireComponent
{
    use WithPagination;

    public $filterCount = 0;
    public $urusanId = '';
    public $bidangUrusanId = '';

    public $bidangUrusans = [];

    public function updatedSearchKeyword()
    {
        if ($this->searchKeyword != '') {
            $this->addFilledFilterAttr('searchKeyword');
        } else {
            $this->removeFilledFilterAttr('searchKeyword');
        }
        $this->resetPage();
    }

    public function updatedUrusanId()
    {
        $this->bidangUrusanId = '';
        $this->bidangUrusans = BidangUrusan::where('urusan_id', $this->urusanId)->orderBy('kode')->get();
    }

    public function applyFilter()
    {
        if ($this->bidangUrusanId) {
            $this->addFilledFilterAttr('bidangUrusanId');
        } else {
            $this->removeFilledFilterAttr('bidangUrusanId');
        }

        $this->resetPage();
        $this->render();
        $this->showFilter = true;
    }

    public function resetFIlter()
    {
        $this->showFilter = false;
        $this->removeFilledFilterAttr('bidangUrusanId');
        $this->urusanId = '';
        $this->bidangUrusanId = '';
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $programs = Program::query()
            ->with('bidangUrusan')
            ->search($this->searchKeyword)
            ->when($this->bidangUrusanId, function ($query) {
                $query->where('bidang_urusan_id', $this->bidangUrusanId);
            })
            ->orderBy('kode')
            ->paginate($this->perPage);

        $urusans = Urusan::orderBy('kode')->get();

        return view('livewire.referensi.program-kegiatan.program-list', [
            'programs' => $programs,
            'urusans' => $urusans
        ]);
    }
}
