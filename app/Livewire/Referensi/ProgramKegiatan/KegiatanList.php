<?php

namespace App\Livewire\Referensi\ProgramKegiatan;

use App\Livewire\LivewireComponent;
use App\Models\BidangUrusan;
use App\Models\Kegiatan;
use App\Models\Program;
use App\Models\Urusan;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

class KegiatanList extends LivewireComponent
{
    use WithPagination;

    public $urusanId = '';
    public $bidangUrusanId = '';
    public $programId = '';

    public $bidangUrusans = [];
    public $programs = [];

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

    public function updatedBidangUrusanId()
    {
        $this->programId = '';
        $this->programs = Program::where('bidang_urusan_id', $this->bidangUrusanId)->orderBy('kode')->get();
    }

    public function applyFilter()
    {
        if ($this->programId) {
            $this->addFilledFilterAttr('programId');
        } else {
            $this->removeFilledFilterAttr('programId');
        }

        $this->resetPage();
        $this->render();
        $this->showFilter = true;
    }

    public function resetFIlter()
    {
        $this->showFilter = false;
        $this->removeFilledFilterAttr('bidangUrusanId');
        $this->removeFilledFilterAttr('programId');
        $this->urusanId = '';
        $this->bidangUrusanId = '';
        $this->programId = '';
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $kegiatans = Kegiatan::query()
            ->with('program')
            ->search($this->searchKeyword)
            ->when($this->programId, function ($query) {
                $query->where('program_id', $this->programId);
            })
            ->orderBy('kode')
            ->paginate($this->perPage);

        $urusans = Urusan::orderBy('kode')->get();

        return view('livewire.referensi.program-kegiatan.kegiatan-list', [
            'kegiatans' => $kegiatans,
            'urusans' => $urusans,
        ]);
    }
}
