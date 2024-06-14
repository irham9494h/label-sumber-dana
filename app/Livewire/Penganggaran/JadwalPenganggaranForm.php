<?php

namespace App\Livewire\Penganggaran;

use App\Models\JadwalPenganggaran;
use App\Models\Tahapan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use WireUi\Traits\Actions;

class JadwalPenganggaranForm extends Component
{
    use Actions;

    public $tahapans;
    public $tahun = '';

    public function mount()
    {
        $this->tahapans = Tahapan::get();
        $this->tahun = Cache::get('tahun');
    }

    #[Validate('required', message: 'Anda belum memilih tahapan.')]
    public $tahapanId = '';

    #[Validate('required', message: 'Nama sub tahapan tidak boleh kosong.')]
    public $namaSubTahapan = '';

    #[Validate('required', message: 'Nomor perda tidak boleh kosong.')]
    public $noPerda = '';

    #[Validate('required', message: 'Tanggal perda tidak boleh kosong.')]
    public $tglPerda = '';

    #[Validate('required', message: 'Nomor Pergub tidak boleh kosong.')]
    public $noPergub = '';

    #[Validate('required', message: 'Tanggal Pergub tidak boleh kosong.')]
    public $tglPergub = '';

    #[Validate('required', message: 'Tanggal RKA tidak boleh kosong.')]
    public $tglRka = '';

    #[Validate('required', message: 'Tanggal DPA tidak boleh kosong.')]
    public $tglDpa = '';

    public function create()
    {
        $this->validate();

        try {
            DB::beginTransaction();
            $created = JadwalPenganggaran::create([
                'tahapan_id' => $this->tahapanId,
                'tahun' => $this->tahun,
                'nama_sub_tahapan' => $this->namaSubTahapan,
                'no_perda' => $this->noPerda,
                'tgl_perda' => $this->tglPerda,
                'no_perkada' => $this->noPergub,
                'tgl_perkada' => $this->tglPergub,
                'tgl_rka' => $this->tglRka,
                'tgl_dpa' => $this->tglDpa,
            ]);
            DB::commit();

            $this->resetForm();
            $this->notification()->success('Berhasil', 'Jadwal penganggaran SIPD tersimpan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->notification()->error('Gagal!', 'Terjadi kesalahan saat menyimpan data, ' . $th->getMessage());
        }
    }

    public function resetForm()
    {
        $this->tahapanId = '';
        $this->tahun = '';
        $this->namaSubTahapan = '';
        $this->noPerda = '';
        $this->tglPerda = '';
        $this->noPergub = '';
        $this->tglPergub = '';
        $this->tglRka = '';
        $this->tglDpa = '';
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.penganggaran.jadwal-penganggaran-form');
    }
}
