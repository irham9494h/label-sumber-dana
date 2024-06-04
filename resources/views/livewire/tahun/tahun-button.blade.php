<?php

use function Livewire\Volt\{state};

state([
    'tahun' => fn() => Cache::get('tahun'),
]);

?>

<div>
    <x-button outline secondary class="w-full" href="{{ route('tahun.pilih-tahun') }}">
        <span class="whitespace-nowrap shrink-0"> Tahun: <span class="font-semibold">{{ $tahun }}</span></span>
    </x-button>
</div>
