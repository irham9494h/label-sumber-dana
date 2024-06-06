<?php

namespace App\Livewire\Forms\Jadwal;

use App\Models\JadwalPenganggaran;
use App\Models\Tahapan;
use Illuminate\Support\Facades\Cache;

use Livewire\Attributes\Validate;
use Livewire\Form;

class FormJadwalPenganggaran extends Form
{
    public $tahun = '';

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

    #[Validate('required', message: 'Tanggal pergub tidak boleh kosong.')]
    public $tglPergub = '';


    public function fetchTahapan()
    {
        return Tahapan::get()->toArray();
    }

    public function store()
    {
        JadwalPenganggaran::create([
            'tahapan_id' => $this->tahapanId,
            'tahun' => $this->tahun,
            'nama_sub_tahapan' => $this->namaSubTahapan,
            'no_perda' => $this->noPerda,
            'tgl_perda' => $this->tglPerda,
            'no_perkada' => $this->noPergub,
            'tgl_perkada' => $this->tglPergub,
        ]);
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
    }
}
