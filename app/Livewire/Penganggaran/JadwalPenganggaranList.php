<?php

namespace App\Livewire\Penganggaran;

use App\Livewire\LivewireComponent;
use App\Models\JadwalPenganggaran;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use WireUi\Traits\Actions;

use function Laravel\Prompts\select;

class JadwalPenganggaranList extends LivewireComponent
{
    use Actions;

    public $tahun;
    public $showDetailModal = false;
    public $searchKeyword = '';
    public $selectedJadwal = null;

    public function mount()
    {
        $this->tahun = Cache::get('tahun');
    }

    public function setSelectedJadwal(JadwalPenganggaran $jadwalPenganggaran)
    {
        $this->selectedJadwal = $jadwalPenganggaran;
    }

    public function delete($jadwalId)
    {
        try {
            DB::beginTransaction();
            JadwalPenganggaran::find($jadwalId)->delete();
            DB::commit();
            $this->notification()->success('Berhasil', 'Jadwal penganggaran SIPD terhapus.');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->notification()->error('Gagal!', 'Terjadi kesalahan saat menghapus data, ' . $th->getMessage());
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $jadwalPenganggarans = JadwalPenganggaran::query()
            ->search($this->searchKeyword)
            ->where('tahun', $this->tahun)
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.penganggaran.jadwal-penganggaran-list', [
            'jadwalPenganggarans' => $jadwalPenganggarans
        ]);
    }
}
