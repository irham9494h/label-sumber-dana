@php
$currentUrusanId = null;
@endphp

<div>
    @push('header')
    <x-layouts.header title="List Bidang Urusan" />
    @endpush

    <x-card shadow="shadow-sm" padding="px-0 py-4">
        <div class="flex flex-col sm:flex-row gap-2 px-4 pb-4 ">
            <div class="max-w-xs w-full">
                <x-input placeholder="Cari urusan atau bidang urusan.." wire:model.live.debounce="searchKeyword" />
            </div>

            <x-select placeholder="Pilih urusan" wire:model.live.debounce="urusanId" class="w-full">
                @foreach($urusans as $key => $urusan)
                <x-select.option label="{{ $urusan->kode }} - {{ $urusan->nama }}" value="{{ $urusan->id }}" />
                @endforeach
            </x-select>
            <div wire:loading wire:target='searchKeyword,urusanId'>
                <span class="text-xs text-gray-400">Mencari...</span>
            </div>
        </div>

        @if (count($bidangUrusans) > 0)

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right">
                <thead class="text-xs uppercase bg-primary-50">
                    <tr class="border-gray-200 border-y">
                        <th scope="col" class="w-10 px-6 py-3">
                            <span class="sr-only">No</span>
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase">
                            Bidang Urusan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($bidangUrusans as $key => $bidangUrusan)

                    @if($bidangUrusan->urusan_id != $currentUrusanId)
                    <tr class="bg-white border-b border-slate-300 hover:bg-gray-50 ">
                        <td class="px-6 py-2 whitespace-nowrap">
                        </td>
                        <td class="px-6 py-2 whitespace-nowrap font-semibold" colspan="2">
                            [URUSAN] {{ $bidangUrusan->urusan->kode}} {{
                            $bidangUrusan->urusan->nama}}
                        </td>
                    </tr>

                    @php
                    $currentUrusanId = $bidangUrusan->urusan_id;
                    @endphp
                    @endif

                    <tr class="bg-white border-b border-slate-300 hover:bg-gray-50 ">
                        <td class="px-6 py-2 whitespace-nowrap">
                            {{ $bidangUrusans->firstItem() + $key }}
                        </td>
                        <td class="px-6 py-2 whitespace-nowrap">
                            <span class="font-semibold">{{ $bidangUrusan->kode }}</span> - {{ $bidangUrusan->nama }}
                        </td>
                        <td class="flex justify-end gap-1 px-6 py-2">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-4 pt-4">
            {{ $bidangUrusans->onEachSide(1)->links() }}
        </div>

        @else

        <x-no-data title="Tidak ada data" />

        @endif

    </x-card>

</div>