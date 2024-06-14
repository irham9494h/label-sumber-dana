@push('header')
    <x-layouts.header title="Form Tambah Jadwal Penganggaran" />
@endpush

<div>
    <form wire:submit="submit">
        <x-card shadow="shadow-sm">
            <div class="space-y-3">
                <x-native-select label="Pilih Tahapan" placeholder="Pilih Tahapan APBD" :options="$tahapans"
                    option-label="nama" option-value="id" wire:model="tahapanId" />

                <x-input label="Nama Sub Tahapan" placeholder="Perubahan II" wire:model="namaSubTahapan" />

                <div class="grid grid-cols-2 gap-3">
                    <x-input label="Nomor Perda" x-mask="99 Tahun 9999" placeholder="10 Tahun 2024"
                        wire:model="noPerda" />

                    <x-datetime-picker label="Tanggal Perda" id="tgl_perda" placeholder="17-03-2024"
                        wire:model="tglPerda" class="block" without-timezone without-time without-tips
                        display-format="DD-MM-YYYY" parse-format="YYYY-MM-DD" />
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <x-input label="Nomor Pergub" x-mask="99 Tahun 9999" placeholder="10 Tahun 2024"
                        wire:model="noPergub" />

                    <x-datetime-picker label="Tanggal Pergub" id="tgl_pergub" placeholder="17-03-2024"
                        wire:model="tglPergub" class="block" without-timezone without-time without-tips
                        display-format="DD-MM-YYYY" parse-format="YYYY-MM-DD" />
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <x-datetime-picker label="Tanggal RKA" id="tgl_rka" placeholder="17-03-2024" wire:model="tglRka"
                        class="block" without-timezone without-time without-tips display-format="DD-MM-YYYY"
                        parse-format="YYYY-MM-DD" />

                    <x-datetime-picker label="Tanggal DPA" id="tgl_dpa" placeholder="17-03-2024" wire:model="tglDpa"
                        class="block" without-timezone without-time without-tips display-format="DD-MM-YYYY"
                        parse-format="YYYY-MM-DD" />
                </div>
            </div>

            <x-slot name="footer">
                <div class="flex items-center justify-between">
                    <x-button flat secodary label="Kembali" href="{{ route('penganggaran.jadwal.list') }}" />
                    @if (!$jadwalId)
                        <x-button type="submit" label="Simpan" primary spinner />
                    @else
                        <x-button type="submit" label="Simpan Perubahan" primary spinner />
                    @endif
                </div>
            </x-slot>
        </x-card>
    </form>
</div>
