<?php

namespace App\Livewire\Forms\Jadwal;

use App\Models\Tahapan;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormJadwalPenganggaran extends Form
{
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
}
