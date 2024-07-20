@php
$currentUnitSkpdId = null;
$currentBidangUrusanId = null;
$currentUrusanId = null;
$currentProgramId = null;
$currentKegiatanId = null;
@endphp

<div x-data="{
    showPilihTahapanDialog: @entangle('showPilihTahapanDialog').live,
}">
    @push('header')
    <x-layouts.header title="Sub Kegiatan Belanja SKPD">
        <h4 class="text-base font-medium text-right">{{ $skpd->nama }}</h4>
    </x-layouts.header>
    @endpush

    <div class="mb-4">
        <x-card shadow="shadow-sm" padding="p-4">
            @if($currentJadwalPenggaran)

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

            @else

            <div class="flex flex-col gap-1.5 justify-center items-center text-sm">
                <p>
                    <span class="font-semibold">
                        Jadwal Pengaggaran belum tersedia, <a href="{{ route('penganggaran.jadwal.form') }}"
                            wire:navigate class="text-blue-600 underline">tambah jadwal</a> penganggaran baru untuk
                        menampilkan data sub kegiatan belanja.
                    </span>
                </p>
            </div>

            @endif
        </x-card>
    </div>

    <div class="mb-4">
        <div class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
            <x-stats.simple-card label="Total Sub Kegiatan" :value="number_format($totalRows, 0, ',','.')" />
            <x-stats.simple-card label="Total Murni"
                :value="number_format($overview->total_harga_murni_sum, 2, ',','.')" />
            <x-stats.simple-card label="Total Perubahan"
                :value="number_format($overview->total_harga_sum, 2, ',','.')" />
        </div>
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

        @if (count($subKegiatanBelanjas) > 0)

        <div class="relative overflow-x-auto">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right">
                    <thead class="text-xs uppercase bg-primary-50">
                        <tr class="border-gray-200 border-y">
                            <th scope="col" class="w-10 pl-6 py-3">
                                <span class="sr-only">No</span>
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase">
                                <div class="sticky left-0">Sub Kegiatan</div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase">
                                Murni
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase">
                                Peribahan
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase">
                                Sumber Dana
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subKegiatanBelanjas as $key => $subKegiatanBelanja)
                        {{-- Show Unit SKPD --}}
                        @if($subKegiatanBelanja->unit_skpd_id != $currentUnitSkpdId)
                        <x-table.row-group colspan="5" padding="pl-2 pr-6 py-2" value="[UNIT SKPD] {{ $subKegiatanBelanja->unitSkpd->kode}} {{
                                                        $subKegiatanBelanja->unitSkpd->nama}}" />
                        @php $currentUnitSkpdId = $subKegiatanBelanja->unit_skpd_id; @endphp
                        @endif

                        {{-- Show Bidang --}}
                        @if($subKegiatanBelanja->bidang_urusan_id != $currentBidangUrusanId)
                        <x-table.row-group colspan="5" padding="pl-2 pr-6 py-2" value="[BIDANG] {{ $subKegiatanBelanja->bidangUrusan->kode}} {{
                                $subKegiatanBelanja->bidangUrusan->nama}}" />
                        @php $currentBidangUrusanId = $subKegiatanBelanja->bidang_urusan_id; @endphp
                        @endif

                        {{-- Show Program --}}
                        @if($subKegiatanBelanja->subKegiatan->kegiatan->program_id != $currentProgramId)
                        <x-table.row-group colspan="5" padding="pl-2 pr-6 py-2" value="[PROGRAM] {{ $subKegiatanBelanja->subKegiatan->kegiatan->program->kode}} {{
                                $subKegiatanBelanja->subKegiatan->kegiatan->program->nama}}" />
                        @php $currentProgramId = $subKegiatanBelanja->subKegiatan->kegiatan->program_id; @endphp
                        @endif

                        {{-- Show Kegiatan --}}
                        @if($subKegiatanBelanja->subKegiatan->kegiatan_id != $currentKegiatanId)
                        <x-table.row-group colspan="5" padding="pl-2 pr-6 py-2" value="[KEGIATAN] {{ $subKegiatanBelanja->subKegiatan->kegiatan->kode}} {{
                                $subKegiatanBelanja->subKegiatan->kegiatan->nama}}" />
                        @php $currentKegiatanId = $subKegiatanBelanja->subKegiatan->kegiatan_id; @endphp
                        @endif

                        <tr x-data="{ showAction : false }" class="border-b border-slate-300"
                            :class="{ 'bg-white hover:bg-gray-50': ! showAction, 'bg-gray-50' : showAction }">
                            <td class="pl-6 py-2 whitespace-nowrap">
                                {{ $subKegiatanBelanjas->firstItem() + $key }}
                            </td>
                            <td class="pl-2 pr-6 py-2 whitespace-nowrap group">
                                <div class="flex gap-2 items-center">
                                    <div class="w-7 h-7">
                                        <button x-on:click="showAction = !showAction"
                                            class="hidden group-hover:flex p-1.5 transition-colors duration-200 rounded hover:bg-primary-50 hover:border-primary-600 focus:outline-none focus:bg-primary-100 ">
                                            <span :class="{'transition duration-200': true, 'rotate-90' : showAction }">
                                                <x-heroicon-o-chevron-right class="w-4 h-4" />
                                            </span>
                                        </button>
                                    </div>

                                    <div class="flex flex-col transition-transform duration-200">
                                        {{ $subKegiatanBelanja->subKegiatan->kode }} - {{
                                        $subKegiatanBelanja->subKegiatan->nama }}

                                        <div x-show="showAction">
                                            <div class="flex gap-2 pt-1.5">
                                                <x-button outline black sm label="Lihat Sub Kegiatan" wire:navigate />
                                                <x-button primary sm label="Lihat Rincian Belanja" wire:navigate />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-2 whitespace-nowrap min-w-32">
                                {{ number_format($subKegiatanBelanja->total_harga_murni_sum, 2, ',', '.') }}
                            </td>
                            <td class="px-6 py-2 whitespace-nowrap min-w-32">
                                {{ number_format($subKegiatanBelanja->total_harga_sum, 2, '.', ',') }}
                            </td>
                            <td class="px-6 py-2 whitespace-nowrap min-w-32">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="px-4 pt-4">
            {{ $subKegiatanBelanjas->onEachSide(1)->links() }}
        </div>

        @else

        <x-no-data title="Tidak ada data" />

        @endif

    </x-card>

</div>