<?php

namespace App\Livewire\Referensi\ProgramKegiatan;

use App\Livewire\LivewireComponent;
use App\Models\BidangUrusan;
use App\Models\Kegiatan;
use App\Models\Program;
use App\Models\SubKegiatan;
use App\Models\Urusan;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

class SubKegiatanList extends LivewireComponent
{
    use WithPagination;

    public $urusanId = '';
    public $bidangUrusanId = '';
    public $programId = '';
    public $kegiatanId = '';

    public $bidangUrusans = [];
    public $programs = [];
    public $kegiatans = [];

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

    public function updatedProgramId()
    {
        $this->kegiatanId = '';
        $this->kegiatans = Kegiatan::where('program_id', $this->programId)->orderBy('kode')->get();
    }

    public function applyFilter()
    {
        if ($this->kegiatanId) {
            $this->addFilledFilterAttr('kegiatanId');
        } else {
            $this->removeFilledFilterAttr('kegiatanId');
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
        $this->removeFilledFilterAttr('kegiatanId');
        $this->urusanId = '';
        $this->bidangUrusanId = '';
        $this->programId = '';
        $this->kegiatanId = '';
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $subKegiatans = SubKegiatan::query()
            ->with('kegiatan')
            ->search($this->searchKeyword)
            ->when($this->kegiatanId, function ($query) {
                $query->where('kegiatan_id', $this->kegiatanId);
            })
            ->orderBy('kode')
            ->paginate($this->perPage);

        $urusans = Urusan::orderBy('kode')->get();

        return view('livewire.referensi.program-kegiatan.sub-kegiatan-list', [
            'subKegiatans' => $subKegiatans,
            'urusans' => $urusans,
        ]);
    }
}
