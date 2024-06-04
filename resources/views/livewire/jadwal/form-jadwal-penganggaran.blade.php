<?php

use App\Livewire\Forms\Jadwal\FormJadwalPenganggaran;
use function Livewire\Volt\{state};
use function Livewire\Volt\{form};

form(FormJadwalPenganggaran::class);

state([
    'tahapans' => fn() => $this->form->fetchTahapan(),
]);

$save = function () {
    $this->validate();
    dd($this->form);
};

?>

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
                    <x-button type="button" label="Batal" negative outline />
                    <x-button type="submit" label="Simpan" primary />
                </div>
            </x-slot>
        </x-card>
    </form>
</div>
