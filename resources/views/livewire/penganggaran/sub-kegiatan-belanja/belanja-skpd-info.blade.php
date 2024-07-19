<div x-data="{
    showInfoDialog: $wire.entangle('showInfoDialog'),
}">
    <x-button info outline sm label="Info" x-on:click="() => showInfoDialog = true" />

    <x-modal.card title="{{ $belanja['skpd']->kode.' - '.$belanja['skpd']->nama }}" blur align="center" max-width="5xl"
        wire:model="showInfoDialog" x-on:close='() => showInfoDialog = false'>

        <div class="flex-1">
            <div
                class="grid grid-cols-1 bg-white overflow-hidden divide-y divide-gray-300 md:grid-cols-3 md:divide-y-0 md:divide-x">
                <div class="p-4">
                    <div class="font-normal text-sm">Total Sub Kegiatan</div>
                    <div class="mt-1 flex justify-between items-baseline md:block lg:flex">
                        <div class="flex items-baseline text-2xl font-medium">
                            {{ number_format($belanja['total_sub_kegiatan'], 0, ',', '.') }}
                        </div>
                    </div>
                </div>

                <div class="p-4">
                    <div class="font-normal text-sm">Total Sub Kegiatan</div>
                    <div class="mt-1 flex justify-between items-baseline md:block lg:flex">
                        <div class="flex items-baseline text-2xl font-medium">
                            {{ number_format($belanja['total_murni'], 2, ',', '.') }}
                        </div>
                    </div>
                </div>

                <div class="p-4">
                    <div class="font-normal text-sm">Total Sub Kegiatan</div>
                    <div class="mt-1 flex justify-between items-baseline md:block lg:flex">
                        <div class="flex items-baseline text-2xl font-medium">
                            {{ number_format($belanja['total_perubahan'], 2, '.', ',') }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @if($jadwalPenggaran)
        <div class="flex-1 mt-5">
            <div class="divide-y divide-gray-200 text-sm lg:col-span-7">
                <div class="py-3 flex items-center justify-between hover:bg-gray-50">
                    <div class="text-gray-600">Tahapan</div>
                    <div class="font-medium text-gray-900">{{ $jadwalPenggaran->tahapan->nama }}</div>
                </div>

                <div class="py-3 flex items-center justify-between hover:bg-gray-50">
                    <div class="text-gray-600">Sub Tahapan</div>
                    <div class="font-medium text-gray-900">{{ $jadwalPenggaran->nama_sub_tahapan }}</div>
                </div>

                <div class="py-3 flex items-center justify-between hover:bg-gray-50">
                    <div class="text-gray-600">Nomor Perda</div>
                    <div class="font-medium text-gray-900">{{ $jadwalPenggaran->no_perda }}</div>
                </div>

                <div class="py-3 flex items-center justify-between hover:bg-gray-50">
                    <div class="text-gray-600">Tanggal Perda</div>
                    <div class="font-medium text-gray-900">{{ $jadwalPenggaran->tgl_perda }}</div>
                </div>

                <div class="py-3 flex items-center justify-between hover:bg-gray-50">
                    <div class="text-gray-600">Nomor Perkada</div>
                    <div class="font-medium text-gray-900">{{ $jadwalPenggaran->no_perkada }}</div>
                </div>

                <div class="py-3 flex items-center justify-between hover:bg-gray-50">
                    <div class="text-gray-600">Tanggal Perkada</div>
                    <div class="font-medium text-gray-900">{{ $jadwalPenggaran->tgl_perkada }}</div>
                </div>

                <div class="py-3 flex items-center justify-between hover:bg-gray-50">
                    <div class="text-gray-600">Tanggal RKA</div>
                    <div class="font-medium text-gray-900">{{ $jadwalPenggaran->tgl_rka }}</div>
                </div>

                <div class="py-3 flex items-center justify-between hover:bg-gray-50">
                    <div class="text-gray-600">Tanggal DPA</div>
                    <div class="font-medium text-gray-900">{{ $jadwalPenggaran->tgl_dpa }}</div>
                </div>
            </div>
        </div>
        @endif

        <x-slot name="footer">
            <div class="flex justify-end gap-x-4">
                <x-button outline red label="Tutup" x-on:click="close" />
            </div>
        </x-slot>
    </x-modal.card>
</div>