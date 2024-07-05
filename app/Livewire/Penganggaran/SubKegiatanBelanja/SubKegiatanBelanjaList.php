<?php

namespace App\Livewire\Penganggaran\SubKegiatanBelanja;

use App\Livewire\LivewireComponent;
use App\Models\JadwalPenganggaran;
use App\Models\RincianBelanja;
use App\Models\Skpd;
use App\Models\Tahapan;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Cache;
use WireUi\Traits\Actions;

class SubKegiatanBelanjaList extends LivewireComponent
{

    use WithPagination, Actions;

    public $showPilihTahapanDialog = false;

    public $tahun = '';

    public $tahapans = [];
    public $jadwalPenganggarans = [];
    public $currentJadwalPenggaran = null;

    public $tahapanId = '';
    public $jadwalPenganggaranId = '';

    public function mount()
    {
        $this->tahun = Cache::get('tahun');

        $this->tahapans = Tahapan::get();

        $this->jadwalPenganggarans = JadwalPenganggaran::query()
            ->with('tahapan')
            ->where('tahun', $this->tahun)
            ->latest()
            ->get();

        if (count($this->jadwalPenganggarans) > 0) {
            $this->currentJadwalPenggaran = $this->jadwalPenganggarans[0];

            $this->tahapanId = $this->currentJadwalPenggaran->tahapan_id;
            $this->jadwalPenganggaranId = $this->currentJadwalPenggaran->id;
        }
    }

    public function updatedSearchKeyword()
    {
        $this->resetPage();
    }

    public function updatedTahapanId()
    {
        $this->jadwalPenganggaranId = '';
        $this->jadwalPenganggarans = JadwalPenganggaran::with('tahapan')->where('tahapan_id', $this->tahapanId)->latest()->get();
    }

    public function applyFilterTahapan()
    {
        if (!$this->tahapanId || !$this->jadwalPenganggaranId) {
            $this->notification()->error(
                $title = 'Gagal !!!',
                $description = 'Anda harus memilik tahapan dan jadwal penganggaran.'
            );
        } else {
            $jadwalPenganggaran = JadwalPenganggaran::query()
                ->with('tahapan')
                ->where('id', $this->jadwalPenganggaranId)
                ->first();

            $this->currentJadwalPenggaran = $jadwalPenganggaran;
            $this->showPilihTahapanDialog = false;

            $this->resetPage();
            $this->render();
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $jadwalPenganggaranId = $this->jadwalPenganggaranId;
        $tahun = $this->tahun;

        $belanjaSkpds = Skpd::query()
            ->with([
                'belanjas' => function ($query) use ($jadwalPenganggaranId, $tahun) {
                    $query->whereHas('jadwalPenganggaran', function ($query) use ($jadwalPenganggaranId, $tahun) {
                        $query->where('id', $jadwalPenganggaranId)
                            ->where('tahun', $tahun);
                    });
                },
            ])
            ->search($this->searchKeyword)
            ->orderBy('kode')
            ->paginate($this->perPage);

        $belanjaSkpdCascadings = [];

        foreach ($belanjaSkpds as $key => $value) {
            $belanjaIds = $value->belanjas->select('id')->pluck('id')->toArray();
            $sumHarga = RincianBelanja::whereIn('belanja_id', $belanjaIds)->get();

            array_push($belanjaSkpdCascadings, [
                'skpd' => $value,
                'total_sub_kegiatan' => count($belanjaIds),
                'total_murni' => $sumHarga->sum('total_harga_murni'),
                'total_perubahan' => $sumHarga->sum('total_harga'),
                'realisasi' => 0
            ]);
        }

        return view('livewire.penganggaran.sub-kegiatan-belanja.sub-kegiatan-belanja-list', [
            'belanjaSkpds' => $belanjaSkpds,
            'belanjaSkpdCascadings' => $belanjaSkpdCascadings
        ]);
    }
}
