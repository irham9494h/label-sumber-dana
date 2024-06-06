<?php

namespace App\Livewire\Forms\SumberDana;

use App\Models\JadwalPenganggaran;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UploadData extends Form
{
    public function fetchJadwalPenganggaran()
    {
        return JadwalPenganggaran::query()
            ->where('tahun', cache()->get('tahun'))
            ->latest()
            ->get();
    }
}
