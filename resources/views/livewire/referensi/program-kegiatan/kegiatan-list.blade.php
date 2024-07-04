@php
$currentUrusanId = null;
$currentBidangUrusanId = null;
$currentProgramId = null;
@endphp

<div x-data="{
    showFilter : @entangle('showFilter'),
    urusanId : @entangle('urusanId'),
    bidangUrusanId : @entangle('bidangUrusanId'),
    programId : @entangle('programId'),
}">
    @push('header')
    <x-layouts.header title="List Data Program" />
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
                    <x-select placeholder="Pilih bidang urusan" wire:model="programId" x-model="programId"
                        class="w-full">
                        @foreach($programs as $key => $program)
                        <x-select.option label="{{ $program->kode }} - {{ $program->nama }}"
                            value="{{ $program->id }}" />
                        @endforeach
                    </x-select>
                </div>

                <div class="flex justify-between items-center">
                    <x-button outline type="button" wire:click="resetFIlter" wire:loading.attr="disabled"
                        x-bind:disabled="!urusanId || !bidangUrusanId || !programId">
                        Reset
                    </x-button>

                    <x-button primary type="submit" x-bind:disabled="!urusanId || !bidangUrusanId || !programId"
                        wire:loading.attr="disabled" spinner="applyFilter">
                        Filter
                    </x-button>
                </div>
            </form>
        </div>

        @if (count($kegiatans) > 0)

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right">
                <thead class="text-xs uppercase bg-primary-50">
                    <tr class="border-gray-200 border-y">
                        <th scope="col" class="w-10 px-6 py-3">
                            <span class="sr-only">No</span>
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase">
                            Kegiatan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kegiatans as $key => $kegiatan)

                    {{-- Show Urusan --}}
                    @if($kegiatan->program->bidangUrusan->urusan_id != $currentUrusanId)
                    <tr class="bg-white border-b border-slate-300 hover:bg-gray-50 ">
                        <td class="px-6 py-2 whitespace-nowrap">
                        </td>
                        <td class="px-6 py-2 whitespace-nowrap font-semibold" colspan="2">
                            [URUSAN] {{ $kegiatan->program->bidangUrusan->urusan->kode}} {{
                            $kegiatan->program->bidangUrusan->urusan->nama}}
                        </td>
                    </tr>

                    @php
                    $currentUrusanId = $kegiatan->program->bidangUrusan->urusan->id;
                    @endphp
                    @endif

                    {{-- Show Bidang Urusan --}}
                    @if($kegiatan->program->bidangUrusan->id != $currentBidangUrusanId)
                    <tr class="bg-white border-b border-slate-300 hover:bg-gray-50 ">
                        <td class="px-6 py-2 whitespace-nowrap">
                        </td>
                        <td class="px-6 py-2 whitespace-nowrap font-semibold" colspan="2">
                            [BIDANG URUSAN] {{ $kegiatan->program->bidangUrusan->kode}} {{
                            $kegiatan->program->bidangUrusan->nama}}
                        </td>
                    </tr>

                    @php
                    $currentBidangUrusanId = $kegiatan->program->bidangUrusan->id;
                    @endphp
                    @endif

                    {{-- Show Program --}}
                    @if($kegiatan->program_id != $currentProgramId)
                    <tr class="bg-white border-b border-slate-300 hover:bg-gray-50 ">
                        <td class="px-6 py-2 whitespace-nowrap">
                        </td>
                        <td class="px-6 py-2 whitespace-nowrap font-semibold" colspan="2">
                            [PROGRAM] {{ $kegiatan->program->kode}} {{
                            $kegiatan->program->nama}}
                        </td>
                    </tr>

                    @php
                    $currentProgramId = $kegiatan->program_id;
                    @endphp
                    @endif

                    <tr class="bg-white border-b border-slate-300 hover:bg-gray-50 ">
                        <td class="px-6 py-2 whitespace-nowrap">
                            {{ $kegiatans->firstItem() + $key }}
                        </td>
                        <td class="px-6 py-2 whitespace-nowrap">
                            <span class="font-semibold">{{ $kegiatan->kode }}</span> - {{ $kegiatan->nama }}
                        </td>
                        <td class="flex justify-end gap-1 px-6 py-2">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-4 pt-4">
            {{ $kegiatans->onEachSide(1)->links() }}
        </div>

        @else

        <x-no-data title="Tidak ada data" />

        @endif

    </x-card>
</div>