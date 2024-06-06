<?php
use function Livewire\Volt\{layout, state, uses, with, usesPagination};
use Livewire\WithoutUrlPagination;
use WireUi\Traits\Actions;
use App\Models\JadwalPenganggaran;

layout('layouts.app');
uses([Actions::class, WithoutUrlPagination::class]);
usesPagination();

state([]);

with(
    fn() => [
        'jadwalPenganggarans' => JadwalPenganggaran::paginate(10),
    ],
);

?>

@inject('carbon', 'Carbon\Carbon')

@push('header')
    <x-layouts.header title="List Jadwal Penganggaran SIPD" />
@endpush

<x-card shadow="shadow-sm" padding="px-0 py-4">
    <div class="flex justify-end px-4 pb-4 ">
        <x-button primary href="{{ route('jadwal-penganggaran.form') }}" wire:navigate>Tambah Tahapan Baru</x-button>
    </div>

    @if ($jadwalPenganggarans)
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right">
                <thead class="text-xs uppercase bg-primary-50">
                    <tr class="border-gray-200 border-y">
                        <th scope="col" class="w-10 px-6 py-3">
                            <span class="sr-only">No</span>
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase">
                            Tahapan
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase">
                            Nama Sub Tahapan
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase">
                            No. Perda
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase">
                            Tgl. Perda
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase">
                            No. Perkada
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase">
                            Tgl. Perkada
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwalPenganggarans as $key => $jadwal)
                        <tr class="border-b border-gray-200 odd:bg-white even:bg-gray-50 hover:bg-gray-50 ">
                            <td class="px-6 py-2">
                                {{ $jadwalPenganggarans->firstItem() + $key }}
                            </td>
                            <td class="px-6 py-2">
                                {{ $jadwal->tahapan->nama }}
                            </td>
                            <td class="px-6 py-2">
                                {{ $jadwal->nama_sub_tahapan }}
                            </td>
                            <td class="px-6 py-2">
                                {{ $jadwal->no_perda }}
                            </td>
                            <td class="px-6 py-2">
                                {{ $carbon::parse($jadwal->tgl_perda)->format('d-m-Y') }}
                            </td>
                            <td class="px-6 py-2">
                                {{ $jadwal->no_perkada }}
                            </td>
                            <td class="px-6 py-2">
                                {{ $carbon::parse($jadwal->tgl_perkada)->format('d-m-Y') }}
                            </td>
                            <td class="px-6 py-2 space-y-2 text-right divide-x divide-orange-600 ">
                                {{-- <button wire:click='downloadFile("{{ $laporanPajak->id }}")'
                                    class="font-medium text-green-600 hover:underline">Download</button>

                                <a href="{{ asset('storage/' . $laporanPajak->file_path) }}" target="_blank"
                                    class="pl-1 font-medium text-blue-500 hover:underline">Lihat</a> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="px-4 pt-4">
                {{ $jadwalPenganggarans->links() }}
            </div>
        </div>
    @else
        <x-no-data title="Tidak ada data" description="Tidak ada tahapan APBD.">
            <x-button label="Tambah Tahapan Baru" primary href="{{ route('jadwal-penganggaran.form') }}"
                wire:navigate />
        </x-no-data>
    @endif
</x-card>
