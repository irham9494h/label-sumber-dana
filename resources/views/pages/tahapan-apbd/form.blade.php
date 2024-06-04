<?php
use function Laravel\Folio\name;

name('tahapan-apbd.form');
?>

<x-app-layout>
    @push('header')
        <x-layouts.header title="Form Tambah APBD" />
    @endpush

    <div class="w-full max-w-5xl mx-auto">
        <x-card shadow="shadow-sm">

            <form action="">
                <div class="space-y-3">
                    <x-inputs.number label="Tahun" min="2020" step="1" />

                    <x-input label="Nama Tahapan" placeholder="Perubahan II" />

                    <x-input label="Tanggal" x-mask="99 Tahun 9999" placeholder="10 Tahun 2024" />

                    <x-input label="Nomor Pergub" x-mask="99 Tahun 9999" placeholder="10 Tahun 2024" />

                    <x-input label="Nomor Perda" x-mask="99 Tahun 9999" placeholder="20 Tahun 2024" />
                </div>

                <x-slot name="footer">
                    <div class="flex justify-between items-center">
                        <x-button label="Delete" negative />
                        <x-button label="Save" primary />
                    </div>
                </x-slot>
            </form>

        </x-card>
    </div>
</x-app-layout>
