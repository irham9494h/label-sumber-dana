<?php

namespace App\Livewire\Penganggaran;

use App\Models\JadwalPenganggaran;
use App\Models\Tahapan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;


class JadwalPenganggaranForm extends Component
{


    public $tahapans;
    public $tahun = '';
    public $jadwalId = null;

    public function mount($id = null)
    {
        if ($id) $this->fillForm($id);

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

    public function submit()
    {
        $this->validate();

        $data = [
            'tahapan_id' => $this->tahapanId,
            'tahun' => $this->tahun,
            'nama_sub_tahapan' => $this->namaSubTahapan,
            'no_perda' => $this->noPerda,
            'tgl_perda' => $this->tglPerda,
            'no_perkada' => $this->noPergub,
            'tgl_perkada' => $this->tglPergub,
            'tgl_rka' => $this->tglRka,
            'tgl_dpa' => $this->tglDpa,
        ];

        if (!$this->jadwalId) {
            $this->create($data);
        } else {
            $this->update($data);
        }
    }

    public function create(array $data)
    {
        try {
            DB::beginTransaction();
            JadwalPenganggaran::create($data);
            DB::commit();
            $this->resetForm();
            $this->notification()->success('Berhasil', 'Jadwal penganggaran SIPD tersimpan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->notification()->error('Gagal!', 'Terjadi kesalahan saat menyimpan data, ' . $th->getMessage());
        }
    }

    public function update(array $data)
    {
        try {
            DB::beginTransaction();
            JadwalPenganggaran::find($this->jadwalId)->update($data);
            DB::commit();
            $this->notification()->success('Berhasil', 'Jadwal penganggaran SIPD diperbaharui.');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->notification()->error('Gagal!', 'Terjadi kesalahan saat mengubah data, ' . $th->getMessage());
        }
    }

    public function fillForm($jadwalId)
    {
        $this->jadwalId = $jadwalId;
        $jadwal = JadwalPenganggaran::findOrFail($jadwalId);
        if ($jadwal) {
            $this->tahapanId = $jadwal->tahapan_id;
            $this->namaSubTahapan = $jadwal->nama_sub_tahapan;
            $this->noPerda = $jadwal->no_perda;
            $this->tglPerda = $jadwal->tgl_perda;
            $this->noPergub = $jadwal->no_perkada;
            $this->tglPergub = $jadwal->tgl_perkada;
            $this->tglRka = $jadwal->tgl_rka;
            $this->tglDpa = $jadwal->tgl_dpa;
        }
    }

    public function resetForm()
    {
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
