<div>
    @push('header')
    <x-layouts.header title="Sub Kegiatan Belanja" />
    @endpush

    <div class="mb-4">
        <x-card shadow="shadow-sm" padding="p-4">
            <div class="flex flex-col gap-1.5 justify-center items-center">
                <p><span>[{{ $currentJadwalPenggaran->tahapan->nama }}]</span> - {{
                    $currentJadwalPenggaran->nama_sub_tahapan }}</p>

                <x-button flat label="Pilih tahapan lainnya" />
            </div>
        </x-card>
    </div>

    <x-card shadow="shadow-sm" padding="px-0 py-4">
        <div class="flex flex-col sm:flex-row justify-start px-4 pb-4 gap-2">
            <div class="max-w-xs w-full">
                <x-input placeholder="Pencarian..." wire:model.live.debounce="searchKeyword" />
                <div wire:loading wire:target='searchKeyword'>
                    <span class="text-xs text-gray-400">Mencari...</span>
                </div>
            </div>

            <div class="max-w-xl w-full">
                <x-select placeholder="Pilih jadwal penganggaran" wire:model.live.debounce="penganggaranId"
                    class="w-full">
                    @foreach($jadwalPenganggarans as $key => $jadwal)
                    <x-select.option label="[{{ $jadwal->tahapan->nama }}] - {{ $jadwal->nama_sub_tahapan }}"
                        value="{{ $jadwal->id }}" />
                    @endforeach
                </x-select>
            </div>
        </div>

        @if (count($belanjaSkpds) > 0)

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right">
                <thead class="text-xs uppercase bg-primary-50">
                    <tr class="border-gray-200 border-y">
                        <th scope="col" class="w-10 px-6 py-3">
                            <span class="sr-only">No</span>
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase">
                            <div class="sticky left-0">Perangkat Daerah</div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase">
                            Total Sub Kegiatan
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase">
                            Sebelum Perubahan
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase">
                            Setelah Perubahan
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase">
                            Realisasi
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($belanjaSkpds as $key => $skpd)
                    <tr class="bg-white border-b border-slate-300 hover:bg-gray-50 ">
                        <td class="px-6 py-2 whitespace-nowrap">
                            {{ $belanjaSkpds->firstItem() + $key }}
                        </td>
                        <td class="px-6 py-2 whitespace-nowrap">
                            <div class="flex flex-col">
                                <strong>{{ $skpd->kode }}</strong>
                                <span>{{ $skpd->nama }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-2 ">
                            {{ $skpd->total_sub_kegiatan }}
                        </td>
                        <td class="px-6 py-2 ">
                            -
                        </td>
                        <td class="px-6 py-2 ">
                            -
                        </td>
                        <td class="px-6 py-2 ">
                            -
                        </td>
                        <td class="flex justify-end gap-1 px-6 py-2">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-4 pt-4">
            {{ $belanjaSkpds->onEachSide(1)->links() }}
        </div>

        @else

        <x-no-data title="Tidak ada data" />

        @endif

    </x-card>
</div>