@php
$currentUrusanId = null;
$currentBidangUrusanId = null;
@endphp

<div x-data="{
    showFilter : @entangle('showFilter'),
    urusanId : @entangle('urusanId'),
    bidangUrusanId : @entangle('bidangUrusanId'),
}">
    @push('header')
    <x-layouts.header title="List Data Program" />
    @endpush

    <x-card shadow="shadow-sm" padding="px-0 py-4">
        <div class="flex justify-start items-start gap-2 px-4 pb-4">
            <div class="max-w-xs w-full">
                <x-input placeholder="Cari program..." wire:model.live.debounce="searchKeyword" />
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
                    <x-select placeholder="Pilih bidang urusan" wire:model="bidangUrusanId" x-model="bidangUrusanId"
                        class="w-full">
                        @foreach($bidangUrusans as $key => $bidangUrusan)
                        <x-select.option label="{{ $bidangUrusan->kode }} - {{ $bidangUrusan->nama }}"
                            value="{{ $bidangUrusan->id }}" />
                        @endforeach
                    </x-select>
                </div>

                <div class="flex justify-between items-center">
                    <x-button outline type="button" wire:click="resetFIlter" wire:loading.attr="disabled"
                        x-bind:disabled="!urusanId || !bidangUrusanId">
                        Reset
                    </x-button>

                    <x-button primary type="submit" x-bind:disabled="!urusanId || !bidangUrusanId"
                        wire:loading.attr="disabled" spinner="applyFilter">
                        Filter
                    </x-button>
                </div>
            </form>
        </div>

        @if (count($programs) > 0)

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right">
                <thead class="text-xs uppercase bg-primary-50">
                    <tr class="border-gray-200 border-y">
                        <th scope="col" class="w-10 px-6 py-3">
                            <span class="sr-only">No</span>
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase">
                            Program
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($programs as $key => $program)

                    {{-- Show Urusan --}}
                    @if($program->bidangUrusan->urusan_id != $currentUrusanId)
                    <tr class="bg-white border-b border-slate-300 hover:bg-gray-50 ">
                        <td class="px-6 py-2 whitespace-nowrap">
                        </td>
                        <td class="px-6 py-2 whitespace-nowrap font-semibold" colspan="2">
                            [URUSAN] {{ $program->bidangUrusan->urusan->kode}} {{
                            $program->bidangUrusan->urusan->nama}}
                        </td>
                    </tr>

                    @php
                    $currentUrusanId = $program->bidangUrusan->urusan->id;
                    @endphp
                    @endif

                    {{-- Show Bidang Urusan --}}
                    @if($program->bidangUrusan->id != $currentBidangUrusanId)
                    <tr class="bg-white border-b border-slate-300 hover:bg-gray-50 ">
                        <td class="px-6 py-2 whitespace-nowrap">
                        </td>
                        <td class="px-6 py-2 whitespace-nowrap font-semibold" colspan="2">
                            [BIDANG URUSAN] {{ $program->bidangUrusan->kode}} {{
                            $program->bidangUrusan->nama}}
                        </td>
                    </tr>

                    @php
                    $currentBidangUrusanId = $program->bidangUrusan->id;
                    @endphp
                    @endif

                    <tr class="bg-white border-b border-slate-300 hover:bg-gray-50 ">
                        <td class="px-6 py-2 whitespace-nowrap">
                            {{ $programs->firstItem() + $key }}
                        </td>
                        <td class="px-6 py-2 whitespace-nowrap">
                            <span class="font-semibold">{{ $program->kode }}</span> - {{ $program->nama }}
                        </td>
                        <td class="flex justify-end gap-1 px-6 py-2">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-4 pt-4">
            {{ $programs->onEachSide(1)->links() }}
        </div>

        @else

        <x-no-data title="Tidak ada data" />

        @endif

    </x-card>
</div>