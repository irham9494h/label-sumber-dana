<?php

use function Livewire\Volt\{state, rules, layout};

layout('components.layouts.app');

rules(['selectedTahun' => 'required'])->messages([
    'selectedTahun' => 'Anda belum memilih tahun APBD.',
]);

state([
    'selectedTahun' => Cache::get('tahun', ''),
    'tahuns' => ['2022', '2023', '2024', '2025', '2026', '2027', '2028', '2029', '2030', '2031', '2032'],
]);

$submit = function () {
    $this->validate();

    Cache::put('tahun', $this->selectedTahun);

    return redirect()->route('dashboard');
};

?>

<div class="space-y-4">
    <form wire:submit.prevent="submit" class="space-y-3">
        <x-native-select label="Pilih Tahun" placeholder="Pilih Tahun APBD" :options="$tahuns" wire:model="selectedTahun" />
        <x-button primary type="submit" class="w-full" spinner>
            Masuk
        </x-button>
    </form>

    <div class="pt-4 border-t">
        <x-button outline secondary class="w-full">
            Logout
        </x-button>
    </div>
</div>
