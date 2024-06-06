<?php

use function Livewire\Volt\{layout, state, uses, form};
use WireUi\Traits\Actions;
use App\Livewire\Forms\SumberDana\UploadData;

layout('layouts.app');
uses([Actions::class]);

form(UploadData::class);

state([
    'jadwalPenganggarans' => fn() => $this->form->fetchJadwalPenganggaran(),
]);

?>

@push('header')
    <x-layouts.header title="Upload Data Sumber Dana" />
@endpush

<div>
    <form>
        <x-card shadow="shadow-sm">
            <div class="space-y-3">
                <x-native-select label="Select Status" wire:model="model">
                    <option value="" selected disabled>Pilih Jadwal</option>
                    @foreach ($jadwalPenganggarans as $key => $jadwal)
                        <option value="{{ $jadwal->id }}">
                            {{ $jadwal->tahapan->nama }} - {{ $jadwal->nama_sub_tahapan }}
                        </option>
                    @endforeach
                </x-native-select>

                <x-input wire:model="file" label="Upload File" type="file" accept=".xls,.xlsx,.csv" />
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
