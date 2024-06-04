<?php
use function Laravel\Folio\name;

name('jadwal.penganggaran.form');
?>

<x-app-layout>
    @push('header')
        <x-layouts.header title="Form Tambah Jadwal Penganggaran" />
    @endpush

    <div class="w-full max-w-5xl mx-auto">
        @livewire('jadwal.form-jadwal-penganggaran')
    </div>
</x-app-layout>
