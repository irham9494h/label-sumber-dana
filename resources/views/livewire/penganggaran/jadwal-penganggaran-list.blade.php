@inject('carbon', 'Carbon\Carbon')
<div x-data="{ open: $wire.entangle('showDetailModal').live }">
    @push('header')
        <x-layouts.header title="List Jadwal Penganggaran" />
    @endpush

    <x-card shadow="shadow-sm" padding="px-0 py-4">

        <div class="flex justify-between px-4 pb-4 ">
            <div class="max-w-xs grow">
                <x-input placeholder="Cari jadwal penganggaran.." wire:model.live.debounce="searchKeyword" />
                <div wire:loading wire:target='searchKeyword'>
                    <span class="text-xs text-gray-400">Mencari...</span>
                </div>
            </div>

            <div>
                <x-button primary href="{{ route('penganggaran.jadwal.form') }}" wire:navigate>
                    Tambah Jadwal
                </x-button>
            </div>
        </div>

        @if (count($jadwalPenganggarans) > 0)
            <div class="relative overflow-auto">
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
                                No. Perkada
                            </th>

                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwalPenganggarans as $key => $jadwal)
                            <tr class="bg-white border-b border-slate-300 hover:bg-gray-50 ">
                                <td class="px-6 py-2 whitespace-nowrap">
                                    {{ $jadwalPenganggarans->firstItem() + $key }}
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap">
                                    {{ $jadwal->tahapan->nama }}
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap">
                                    {{ $jadwal->nama_sub_tahapan }}
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap">
                                    {{ $jadwal->no_perda }}
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap">
                                    {{ $jadwal->no_perkada }}
                                </td>
                                <td class="px-6 py-2 text-right">
                                    <x-button.circle 2xs outline info icon="information-circle"
                                        x-on:click="() => {
                                            open = true;
                                            $wire.setSelectedJadwal({{ $jadwal->id }})
                                        }" />
                                    <x-button.circle 2xs outline warning icon="pencil"
                                        href="{{ route('penganggaran.jadwal.form', $jadwal->id) }}" />
                                    <x-button.circle 2xs outline negative icon="trash"
                                        x-on:confirm="{
                                            title: 'Yakin akan menghapus jadwal?',
                                            'description': '[{{ $jadwal->tahapan->nama }}] - {{ $jadwal->nama_sub_tahapan }}',
                                            accept: {
                                                label: 'Ya, hapus',
                                                method: 'delete',
                                                params: {{ $jadwal->id }},
                                            },
                                            reject: {
                                                label: 'Batalkan',
                                            }
                                        }" />
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
            <x-no-data title="Tidak ada data">
                <x-button label="Tambah Jadwal" primary href="{{ route('penganggaran.jadwal.form') }}" wire:navigate />
            </x-no-data>
        @endif

    </x-card>

    <x-modal.card title="Jadwal Penganggaran" wire:model="showDetailModal" x-on:close='open = false'>
        <div wire:loading wire:target='setSelectedJadwal'>
            <x-loading message="Memuat data jadwal..." />
        </div>

        @if ($selectedJadwal)
            <ul class="divide-y divide-gray-100" wire:loading.class='hidden' wire:target='setSelectedJadwal'>
                <li class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <span class="text-sm font-medium text-gray-400">Tahapan</span>
                    <span class="col-span-2 mt-1 text-sm">
                        {{ $selectedJadwal->tahapan->nama }}
                    </span>
                </li>
                <li class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <span class="text-sm font-medium text-gray-400">Nama Sub Tahapan</span>
                    <span class="col-span-2 mt-1 text-sm">
                        {{ $selectedJadwal->nama_sub_tahapan }}
                    </span>
                </li>
                <li class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <span class="text-sm font-medium text-gray-400">Nomor Perda</span>
                    <span class="col-span-2 mt-1 text-sm">
                        {{ $selectedJadwal->no_perda }}
                    </span>
                </li>
                <li class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <span class="text-sm font-medium text-gray-400">Tanggal Perda</span>
                    <span class="col-span-2 mt-1 text-sm">
                        {{ $carbon::parse($selectedJadwal->tgl_perda)->format('d-m-Y') }}
                    </span>
                </li>
                </li>
                <li class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <span class="text-sm font-medium text-gray-400">Nomor Perkada</span>
                    <span class="col-span-2 mt-1 text-sm">
                        {{ $selectedJadwal->no_perkada }}
                    </span>
                </li>
                </li>
                <li class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <span class="text-sm font-medium text-gray-400">Tanggal Perkada</span>
                    <span class="col-span-2 mt-1 text-sm">
                        {{ $carbon::parse($selectedJadwal->tgl_perkada)->format('d-m-Y') }}
                    </span>
                </li>
                </li>
                <li class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <span class="text-sm font-medium text-gray-400">Tanggal RKA</span>
                    <span class="col-span-2 mt-1 text-sm">
                        {{ $carbon::parse($selectedJadwal->tgl_rka)->format('d-m-Y') }}
                    </span>
                </li>
                </li>
                <li class="px-4 py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <span class="text-sm font-medium text-gray-400">Tanggal DPA</span>
                    <span class="col-span-2 mt-1 text-sm">
                        {{ $carbon::parse($selectedJadwal->tgl_dpa)->format('d-m-Y') }}
                    </span>
                </li>
            </ul>
        @endif
    </x-modal.card>

</div>
