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
    <x-layouts.header title="Rincian Belanja Sub Kegiatan">
        {{-- <h4 class="text-base font-medium text-right">{{ $skpd->nama }}</h4> --}}
    </x-layouts.header>
    @endpush

    {{-- <div class="mb-4">
        <div class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
            <x-stats.simple-card label="Total Sub Kegiatan" :value="number_format($totalRows, 0, ',','.')" />
            <x-stats.simple-card label="Total Murni"
                :value="number_format($overview->total_harga_murni_sum, 2, ',','.')" />
            <x-stats.simple-card label="Total Perubahan"
                :value="number_format($overview->total_harga_sum, 2, ',','.')" />
        </div>
    </div> --}}

    <x-card shadow="shadow-sm" padding="px-0 py-4">
        <div class="flex flex-col justify-start px-4 pb-4 gap-2">
            <div class="max-w-xs w-full">
                <x-input placeholder="Pencarian..." wire:model.live.debounce="searchKeyword" />
                <div wire:loading wire:target='searchKeyword'>
                    <span class="text-xs text-gray-400">Mencari...</span>
                </div>
            </div>
        </div>

        @if (count($rincianBelanjas) > 0)

        <div class="relative overflow-x-auto">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right">
                    <thead class="text-xs uppercase bg-primary-50">
                        <tr class="border-gray-200 border-y">
                            <th scope="col" class="w-10 pl-6 py-3" rowspan="2">
                                <span class="sr-only">No</span>
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase"
                                rowspan="2">
                                <div class="sticky left-0">Uraian</div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase"
                                rowspan="2">
                                Koefisien
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-center uppercase"
                                colspan="2">
                                Murni
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-center uppercase"
                                colspan="2">
                                Perubahan
                            </th>
                        </tr>
                        <tr class="border-gray-200 border-y">
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase">
                                Harga Satuan
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase">
                                Total
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase">
                                Harga Satuan
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase">
                                Total
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($rincianBelanjas as $key => $rincian)
                        <tr x-data="{ showAction : false }" class="border-b border-slate-300"
                            :class="{ 'bg-white hover:bg-gray-50': ! showAction, 'bg-gray-50' : showAction }">
                            <td class="pl-6 py-2 whitespace-nowrap">
                                {{ $rincianBelanjas->firstItem() + $key }}
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
                                        <strong>{{ $rincian->standarHarga->nama }}</strong>
                                        <span>{{ $rincian->standarHarga->spek }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-2 whitespace-nowrap min-w-32">
                                {{ $rincian->koefisien }}
                            </td>
                            <td class="px-6 py-2 whitespace-nowrap min-w-32">
                                {{ number_format($rincian->harga_satuan_murni, 2, ',', '.') }}
                            </td>
                            <td class="px-6 py-2 whitespace-nowrap min-w-32">
                                {{ number_format($rincian->total_harga_murni, 2, '.', ',') }}
                            </td>
                            <td class="px-6 py-2 whitespace-nowrap min-w-32">
                                {{ number_format($rincian->harga_satuan, 2, ',', '.') }}
                            </td>
                            <td class="px-6 py-2 whitespace-nowrap min-w-32">
                                {{ number_format($rincian->total_harga, 2, '.', ',') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>

        <div class="px-4 pt-4">
            {{ $rincianBelanjas->onEachSide(1)->links() }}
        </div>

        @else

        <x-no-data title="Tidak ada data" />

        @endif

    </x-card>

</div>