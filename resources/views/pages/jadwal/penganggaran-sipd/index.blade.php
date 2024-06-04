<?php
use function Laravel\Folio\name;

name('tahapan-apbd.index');
?>

<x-app-layout>
    @push('header')
        <x-layouts.header title="List Tahapan APBD" />
    @endpush

    <x-card shadow="shadow-sm" padding="px-0 py-4">
        <div class="flex justify-end px-4 pb-4 ">
            <x-button primary href="{{ route('tahapan-apbd.form') }}" wire:navigate>Tambah Tahapan Baru</x-button>
        </div>

        @if (false)
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right">
                    <thead class="text-xs bg-primary-50 uppercase">
                        <tr class="border-y border-gray-200">
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">No</span>
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                Tahun
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                Nama Tahapan
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                No DPA
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        @else
            <x-no-data title="Tidak ada data" description="Tidak ada tahapan APBD.">
                <x-button label="Tambah Tahapan Baru" primary href="{{ route('tahapan-apbd.form') }}" wire:navigate />
            </x-no-data>
        @endif
    </x-card>

</x-app-layout>
