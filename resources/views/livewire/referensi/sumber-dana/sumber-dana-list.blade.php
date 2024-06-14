<div>
    @push('header')
        <x-layouts.header title="List Sumber Dana" />
    @endpush

    <x-card shadow="shadow-sm" padding="px-0 py-4">

        <div class="flex justify-between px-4 pb-4 ">
            <div class="max-w-xs grow">
                <x-input placeholder="Cari sumber dana.." wire:model.live.debounce="searchKeyword" />
                <div wire:loading wire:target='searchKeyword'>
                    <span class="text-xs text-gray-400">Mencari...</span>
                </div>
            </div>

            <div>
                <x-button primary href="{{ route('penganggaran.jadwal.form') }}" wire:navigate>
                    Tambah Sumber Dana
                </x-button>
            </div>
        </div>

        @if (count($sumberDanas) > 0)
            <div class="relative overflow-auto">
                <table class="w-full text-sm text-left rtl:text-right">
                    <thead class="text-xs uppercase bg-primary-50">
                        <tr class="border-gray-200 border-y">
                            <th scope="col" class="w-10 px-6 py-3">
                                <span class="sr-only">No</span>
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase">
                                Kode
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase">
                                Nama
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sumberDanas as $key => $sumberDana)
                            <tr class="bg-white border-b border-slate-300 hover:bg-gray-50 ">
                                <td class="px-6 py-2 whitespace-nowrap">
                                    {{ $sumberDanas->firstItem() + $key }}
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap">
                                    {{ $sumberDana->kode }}
                                </td>
                                <td class="px-6 py-2 whitespace-nowrap">
                                    [{{ $sumberDana->jenis }}] - {{ $sumberDana->nama }}
                                </td>

                                <td class="flex justify-end gap-1 px-6 py-2">
                                    <x-button.circle 2xs outline warning icon="pencil"
                                        href="{{ route('penganggaran.jadwal.form', $sumberDana->id) }}" />
                                    <x-button.circle 2xs outline negative icon="trash"
                                        x-on:confirm="{
                                            title: 'Yakin akan menghapus jadwal?',
                                            'description': '[{{ $sumberDana->kode }}] - {{ $sumberDana->nama }}',
                                            accept: {
                                                label: 'Ya, hapus',
                                                method: 'delete',
                                                params: {{ $sumberDana->id }},
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
            </div>

            <div class="px-4 pt-4">
                {{ $sumberDanas->links() }}
            </div>
        @else
            <x-no-data title="Tidak ada data">
                <x-button label="Tambah Sumber Dana" primary href="{{ route('penganggaran.jadwal.form') }}"
                    wire:navigate />
            </x-no-data>
        @endif

    </x-card>

</div>
