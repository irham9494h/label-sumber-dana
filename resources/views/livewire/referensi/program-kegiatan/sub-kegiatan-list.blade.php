@php
$currentUrusanId = null;
$currentBidangUrusanId = null;
$currentProgramId = null;
$currentKegiatanId = null;
@endphp

<div x-data="{
    showFilter : @entangle('showFilter'),
    urusanId : @entangle('urusanId'),
    bidangUrusanId : @entangle('bidangUrusanId'),
    programId : @entangle('programId'),
    kegiatanId : @entangle('kegiatanId'),
}">
    @push('header')
    <x-layouts.header title="List Data Sub Kegiatan" />
    @endpush

    <x-card shadow="shadow-sm" padding="px-0 py-4">
        <div class="flex justify-start items-start gap-2 px-4 pb-4">
            <div class="max-w-xs w-full">
                <x-input placeholder="Cari kegiatan..." wire:model.live.debounce="searchKeyword" />
                <div wire:loading wire:target='searchKeyword'>
                    <span class="text-xs text-gray-400">Mencari...</span>
                </div>
            </div>

            <div>
                <x-button primary icon="filter" class="h-9 relative" @click="showFilter = ! showFilter">
                    <div
                        class="h-5 w-5 rounded-full bg-red-400 text-white text-xs -top-1.5 -right-1.5 absolute flex justify-center items-center">
                        <span>{{ count($filledFilter) }}</span>
                    </div>
                </x-button>
            </div>
        </div>

        <div x-show="showFilter" x-collapse class="px-4 pb-4">
            <form wire:submit.prevent="applyFilter" class="space-y-3">

                <x-select placeholder="Pilih urusan" wire:model.live="urusanId" x-model="urusanId" class="w-full">
                    @foreach($urusans as $key => $urusan)
                    <x-select.option label="{{ $urusan->kode }} - {{ $urusan->nama }}" value="{{ $urusan->id }}" />
                    @endforeach
                </x-select>

                <div wire:loading wire:target='urusanId'>
                    <span class="text-xs text-gray-400">Loading bidang urusan...</span>
                </div>

                <div wire:loading.remove wire:target='urusanId'>
                    <x-select placeholder="Pilih bidang urusan" wire:model.live="bidangUrusanId"
                        x-model="bidangUrusanId" class="w-full">
                        @foreach($bidangUrusans as $key => $bidangUrusan)
                        <x-select.option label="{{ $bidangUrusan->kode }} - {{ $bidangUrusan->nama }}"
                            value="{{ $bidangUrusan->id }}" />
                        @endforeach
                    </x-select>
                </div>

                <div wire:loading wire:target='bidangUrusanId'>
                    <span class="text-xs text-gray-400">Loading program...</span>
                </div>

                <div wire:loading.remove wire:target='bidangUrusanId'>
                    <x-select placeholder="Pilih bidang urusan" wire:model.live="programId" x-model="programId"
                        class="w-full">
                        @foreach($programs as $key => $program)
                        <x-select.option label="{{ $program->kode }} - {{ $program->nama }}"
                            value="{{ $program->id }}" />
                        @endforeach
                    </x-select>
                </div>

                <div wire:loading wire:target='programId'>
                    <span class="text-xs text-gray-400">Loading kegiatan...</span>
                </div>

                <div wire:loading.remove wire:target='programId'>
                    <x-select placeholder="Pilih bidang urusan" wire:model="kegiatanId" x-model="kegiatanId"
                        class="w-full">
                        @foreach($kegiatans as $key => $kegiatan)
                        <x-select.option label="{{ $kegiatan->kode }} - {{ $kegiatan->nama }}"
                            value="{{ $kegiatan->id }}" />
                        @endforeach
                    </x-select>
                </div>

                <div class="flex justify-between items-center">
                    <x-button outline type="button" wire:click="resetFIlter" wire:loading.attr="disabled"
                        x-bind:disabled="!urusanId || !bidangUrusanId || !programId || !kegiatanId">
                        Reset
                    </x-button>

                    <x-button primary type="submit"
                        x-bind:disabled="!urusanId || !bidangUrusanId || !programId || !kegiatanId"
                        wire:loading.attr="disabled" spinner="applyFilter">
                        Filter
                    </x-button>
                </div>
            </form>
        </div>

        @if (count($subKegiatans) > 0)

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right">
                <thead class="text-xs uppercase bg-primary-50">
                    <tr class="border-gray-200 border-y">
                        <th scope="col" class="w-10 px-6 py-3">
                            <span class="sr-only">No</span>
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase">
                            SUb Kegiatan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subKegiatans as $key => $subKegiatan)

                    {{-- Show Urusan --}}
                    @if($subKegiatan->kegiatan->program->bidangUrusan->urusan_id != $currentUrusanId)
                    <tr class="bg-white border-b border-slate-300 hover:bg-gray-50 ">
                        <td class="px-6 py-2 whitespace-nowrap"></td>
                        <td class="px-6 py-2 whitespace-nowrap font-semibold" colspan="2">
                            [URUSAN] {{ $subKegiatan->kegiatan->program->bidangUrusan->urusan->kode}} {{
                            $subKegiatan->kegiatan->program->bidangUrusan->urusan->nama}}
                        </td>
                    </tr>

                    @php $currentUrusanId = $subKegiatan->kegiatan->program->bidangUrusan->urusan->id; @endphp
                    @endif

                    {{-- Show Bidang Urusan --}}
                    @if($subKegiatan->kegiatan->program->bidangUrusan->id != $currentBidangUrusanId)
                    <tr class="bg-white border-b border-slate-300 hover:bg-gray-50 ">
                        <td class="px-6 py-2 whitespace-nowrap"></td>
                        <td class="px-6 py-2 whitespace-nowrap font-semibold" colspan="2">
                            [BIDANG URUSAN] {{ $subKegiatan->kegiatan->program->bidangUrusan->kode}} {{
                            $subKegiatan->kegiatan->program->bidangUrusan->nama}}
                        </td>
                    </tr>

                    @php $currentBidangUrusanId = $subKegiatan->kegiatan->program->bidangUrusan->id; @endphp
                    @endif

                    {{-- Show Program --}}
                    @if($subKegiatan->kegiatan->program_id != $currentProgramId)
                    <tr class="bg-white border-b border-slate-300 hover:bg-gray-50 ">
                        <td class="px-6 py-2 whitespace-nowrap"></td>
                        <td class="px-6 py-2 whitespace-nowrap font-semibold" colspan="2">
                            [PROGRAM] {{ $subKegiatan->kegiatan->program->kode}} {{
                            $subKegiatan->kegiatan->program->nama}}
                        </td>
                    </tr>

                    @php $currentProgramId = $subKegiatan->kegiatan->program_id; @endphp
                    @endif

                    {{-- Show Kegiatan --}}
                    @if($subKegiatan->kegiatan_id != $currentKegiatanId)
                    <tr class="bg-white border-b border-slate-300 hover:bg-gray-50 ">
                        <td class="px-6 py-2 whitespace-nowrap"></td>
                        <td class="px-6 py-2 whitespace-nowrap font-semibold" colspan="2">
                            [KEGIATAN] {{ $subKegiatan->kegiatan->kode}} {{
                            $subKegiatan->kegiatan->nama}}
                        </td>
                    </tr>

                    @php $currentKegiatanId = $subKegiatan->kegiatan_id; @endphp
                    @endif

                    <tr class="bg-white border-b border-slate-300 hover:bg-gray-50 ">
                        <td class="px-6 py-2 whitespace-nowrap">
                            {{ $subKegiatans->firstItem() + $key }}
                        </td>
                        <td class="px-6 py-2 whitespace-nowrap">
                            <span class="font-semibold">{{ $subKegiatan->kode }}</span> - {{ $subKegiatan->nama }}
                        </td>
                        <td class="flex justify-end gap-1 px-6 py-2">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-4 pt-4">
            {{ $subKegiatans->onEachSide(1)->links() }}
        </div>

        @else

        <x-no-data title="Tidak ada data" />

        @endif

    </x-card>
</div>