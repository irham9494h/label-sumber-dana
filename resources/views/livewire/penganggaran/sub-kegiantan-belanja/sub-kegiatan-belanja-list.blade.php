<div x-data="{
    showPilihTahapanDialog: @entangle('showPilihTahapanDialog').live,
}">
    @push('header')
    <x-layouts.header title="Sub Kegiatan Belanja" />
    @endpush

    <div class="mb-4">
        <x-card shadow="shadow-sm" padding="p-4">
            <div class="flex flex-col gap-1.5 justify-center items-center text-sm">
                <p>
                    <span class="font-semibold">[{{ $currentJadwalPenggaran->tahapan->nama }}]</span> -
                    {{$currentJadwalPenggaran->nama_sub_tahapan }}
                </p>

                <x-button flat xs label="Pilih tahapan lain" x-on:click="() => {showPilihTahapanDialog = true}" />
            </div>

            <div x-show="showPilihTahapanDialog" x-collapse class="pt-4">
                <div class="bg-blue-50 border-l-4 border-blue-400 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <x-heroicon-o-information-circle class="h-5 w-5 text-blue-400" />
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-700">
                                Pilih tahapan dan jadwal penganggaran untuk menampilkan sub kegiatan belanja.
                            </p>
                        </div>
                    </div>
                </div>

                <form wire:submit.prevent="applyFilterTahapan">
                    <div class="w-full bg-white space-y-3 pt-4">
                        <x-select placeholder="Pilih Tahapan APBD" :options="$tahapans" option-label="nama"
                            option-value="id" wire:model.live="tahapanId" />

                        <div wire:loading wire:target='tahapanId'>
                            <span class="text-xs text-gray-400">Loading jadwal penganggaran...</span>
                        </div>

                        <div wire:loading.remove wire:target='tahapanId'>
                            <x-select placeholder="Pilih Jadwal Penganggaran" :options="$jadwalPenganggarans"
                                option-label="nama_sub_tahapan" option-value="id"
                                wire:model.live="jadwalPenganggaranId" />
                        </div>
                    </div>

                    <div class="pt-3 sm:flex justify-between gap-2">
                        <x-button type="button" outline secondary x-on:click="() => {showPilihTahapanDialog = false}"
                            wire:loading.attr="disabled" wire:target="applyFilterTahapan">
                            Batal</x-button>
                        <x-button primary type="submit" spinner="applyFilterTahapan" wire:loading.attr="disabled">
                            Tampilkan Data
                        </x-button>
                    </div>
                </form>
            </div>
        </x-card>
    </div>

    <x-card shadow="shadow-sm" padding="px-0 py-4">
        <div class="flex flex-col justify-start px-4 pb-4 gap-2">
            <div class="max-w-xs w-full">
                <x-input placeholder="Pencarian..." wire:model.live.debounce="searchKeyword" />
                <div wire:loading wire:target='searchKeyword'>
                    <span class="text-xs text-gray-400">Mencari...</span>
                </div>
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
                    @foreach ($belanjaSkpdCascadings as $key => $belanja)
                    <tr class="bg-white border-b border-slate-300 hover:bg-gray-50 ">
                        <td class="px-6 py-2 whitespace-nowrap">
                            {{ $belanjaSkpds->firstItem() + $key }}
                        </td>
                        <td class="px-6 py-2 whitespace-nowrap">
                            <div class="flex flex-col">
                                <strong>{{ $belanja['skpd']->kode }}</strong>
                                <span>{{ $belanja['skpd']->nama }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-2 whitespace-nowrap min-w-32">
                            {{ number_format($belanja['total_sub_kegiatan'], 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-2 whitespace-nowrap min-w-32">
                            {{ number_format($belanja['total_murni'], 2, ',', '.') }}
                        </td>
                        <td class="px-6 py-2 whitespace-nowrap min-w-32">
                            {{ number_format($belanja['total_perubahan'], 2, '.', ',') }}
                        </td>
                        <td class="px-6 py-2 whitespace-nowrap min-w-32">
                            {{ number_format($belanja['realisasi'], 2, ',', '.') }}
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