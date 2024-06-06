<?php

use App\Livewire\Forms\Jadwal\FormJadwalPenganggaran;
use function Livewire\Volt\{layout, state, form, mount, uses};
use WireUi\Traits\Actions;

layout('layouts.app');

uses([Actions::class]);

form(FormJadwalPenganggaran::class);

mount(function () {
    $this->form->tahun = Cache::get('tahun');
});

state([
    'tahapans' => fn() => $this->form->fetchTahapan(),
]);

$save = function () {
    $this->validate();

    try {
        DB::beginTransaction();
        $this->form->store();
        DB::commit();
        $this->form->resetForm();
        $this->notification()->success('Berhasil', 'Jadwal penganggaran SIPD tersimpan.');
    } catch (\Throwable $th) {
        DB::rollBack();
        $this->notification()->error('Gagal!', 'Terjadi kesalahan saat menyimpan data.');
    }
};

?>

@push('header')
    <x-layouts.header title="Form Tambah Jadwal Penganggaran SIPD" />
@endpush

<div>
    <form wire:submit="save">
        <x-card shadow="shadow-sm">
            <div class="space-y-3">
                <x-native-select label="Pilih Tahapan" placeholder="Pilih Tahapan APBD" :options="$tahapans"
                    option-label="nama" option-value="id" wire:model="form.tahapanId" />

                <x-input label="Nama Sub Tahapan" placeholder="Perubahan II" wire:model="form.namaSubTahapan" />

                <x-input label="Nomor Perda" x-mask="99 Tahun 9999" placeholder="10 Tahun 2024"
                    wire:model="form.noPerda" />

                <x-datetime-picker label="Tanggal Perda" id="tgl_perda" placeholder="17-03-2024"
                    wire:model="form.tglPerda" class="block" without-timezone without-time without-tips
                    display-format="DD-MM-YYYY" parse-format="YYYY-MM-DD" />

                <x-input label="Nomor Pergub" x-mask="99 Tahun 9999" placeholder="10 Tahun 2024"
                    wire:model="form.noPergub" />

                <x-datetime-picker label="Tanggal pergub" id="tgl_pergub" placeholder="17-03-2024"
                    wire:model="form.tglPergub" class="block" without-timezone without-time without-tips
                    display-format="DD-MM-YYYY" parse-format="YYYY-MM-DD" />

            </div>

            <x-slot name="footer">
                <div class="flex items-center justify-between">
                    <x-button flat secodary label="Kembali" href="{{ route('jadwal-penganggaran.list') }}" />
                    <x-button type="submit" label="Simpan" primary spinner />
                </div>
            </x-slot>
        </x-card>
    </form>
</div>
