<?php

namespace App\Livewire\Penganggaran\SubKegiatanBelanja;

use App\Livewire\LivewireComponent;
use App\Models\Belanja;
use App\Models\JadwalPenganggaran;
use App\Models\Skpd;
use App\Models\Tahapan;
use App\Models\UnitSkpd;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

class SubKegiatanBelanjaSkpd extends LivewireComponent
{

    use WithPagination;

    public $showPilihTahapanDialog = false;

    public $skpdId = null;
    public $skpd = null;
    public $tahun = '';

    public $unitSkpdIds = [];
    public $tahapans = [];
    public $jadwalPenganggarans = [];
    public $currentJadwalPenggaran = null;

    public $tahapanId = '';
    public $jadwalPenganggaranId = '';

    public $overviewTotalSubKegiatan = 0;
    public $overviewTotalMurni = 0;
    public $overviewTotalPerubahan = 0;

    public function mount($skpdId)
    {
        $this->$skpdId = $skpdId;
        $this->skpd = Skpd::find($skpdId);

        $this->unitSkpdIds = UnitSkpd::select('id')->where('skpd_id', $skpdId)->get()->toArray();

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

    #[Layout('layouts.app')]
    public function render()
    {
        $subKegiatanBelanjas = Belanja::query()
            ->with([
                'unitSkpd',
                'subKegiatan.kegiatan.program',
                'rincianBelanjas' => function ($query) {
                    $query->selectRaw('belanja_id, sum(total_harga_murni) as total_harga_murni_sum, sum(total_harga) as total_harga_sum')
                        ->groupBy('belanja_id');
                }
            ])
            ->select('belanjas.*', DB::raw('sum(rincian_belanjas.total_harga_murni) as total_harga_murni_sum'), DB::raw('sum(rincian_belanjas.total_harga) as total_harga_sum'))
            ->join('rincian_belanjas', 'belanjas.id', '=', 'rincian_belanjas.belanja_id')
            ->whereIn(
                'unit_skpd_id',
                $this->unitSkpdIds
            )
            ->where('jadwal_penganggaran_id', $this->jadwalPenganggaranId)
            ->groupBy('sub_kegiatan_id', 'unit_skpd_id')
            ->paginate($this->perPage);

        $overview =
            Belanja::query()
            ->select(DB::raw('sum(rincian_belanjas.total_harga_murni) as total_harga_murni_sum'), DB::raw('sum(rincian_belanjas.total_harga) as total_harga_sum'))
            ->join('rincian_belanjas', 'belanjas.id', '=', 'rincian_belanjas.belanja_id')
            ->whereIn(
                'unit_skpd_id',
                $this->unitSkpdIds
            )
            ->where('jadwal_penganggaran_id', $this->jadwalPenganggaranId)
            ->first();

        $totalRows = Belanja::query()
            ->whereIn('unit_skpd_id', $this->unitSkpdIds)
            ->where('jadwal_penganggaran_id', $this->jadwalPenganggaranId)
            ->count();

        return view('livewire.penganggaran.sub-kegiatan-belanja.sub-kegiatan-belanja-skpd', [
            'subKegiatanBelanjas' => $subKegiatanBelanjas,
            'overview' => $overview,
            'totalRows' => $totalRows,
        ]);
    }
}
