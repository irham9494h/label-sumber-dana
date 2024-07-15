<?php

namespace App\Livewire\Penganggaran\SubKegiatanBelanja;

use App\Livewire\LivewireComponent;
use App\Models\JadwalPenganggaran;
use App\Models\Skpd;
use App\Models\Tahapan;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Cache;
use WireUi\Traits\Actions;

class SubKegiatanBelanjaOverview extends LivewireComponent
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

        $belanjaSkpds = Skpd::query()
            ->withCount([
                'belanjas' => function ($query) use ($jadwalPenganggaranId) {
                    $query->whereHas('jadwalPenganggaran', function ($query) use ($jadwalPenganggaranId) {
                        $query->where('id', $jadwalPenganggaranId);
                    });
                }
            ])
            ->with([
                'rincianBelanjas' => function ($query) use ($jadwalPenganggaranId) {
                    $query->selectRaw('sum(total_harga_murni) as total_harga_murni_sum, sum(total_harga) as total_harga_sum')
                        ->join('belanjas as t_belanja', 'rincian_belanjas.belanja_id', '=', 't_belanja.id')
                        ->where('t_belanja.jadwal_penganggaran_id', $jadwalPenganggaranId)
                        ->groupBy('rincian_belanjas.belanja_id');
                }
            ])
            ->paginate(20)
            ->through(function ($skpd) {
                $total_harga_murni_sum = $skpd->rincianBelanjas->sum('total_harga_murni_sum');
                $total_harga_sum = $skpd->rincianBelanjas->sum('total_harga_sum');
                return [
                    'skpd' => $skpd,
                    'total_sub_kegiatan' => $skpd->belanjas_count,
                    'total_murni' => $total_harga_murni_sum,
                    'total_perubahan' => $total_harga_sum,
                    'realisasi' => 0
                ];
            });

        return view('livewire.penganggaran.sub-kegiatan-belanja.sub-kegiatan-belanja-overview', [
            'belanjaSkpds' => $belanjaSkpds,
        ]);
    }
}
