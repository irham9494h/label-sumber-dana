<div>

    @push('header')
        <x-layouts.header title="Upload Data Belanja (Rekap 17 SIPD)" />
    @endpush

    <div>
        <form wire:submit="import" enctype="multipart/form-data">
            <x-card shadow="shadow-sm">
                <div class="space-y-3">
                    <x-native-select label="Pilih Jadwal Penganggaran SIPD" wire:model="jadwalPenganggaranId"
                        wire:loading.attr='disabled' wire:target="file,import">
                        <option value="" selected disabled>Pilih Jadwal</option>
                        @foreach ($jadwalPenganggarans as $key => $jadwal)
                            <option value="{{ $jadwal->id }}">
                                {{ $jadwal->tahapan->nama }} - {{ $jadwal->nama_sub_tahapan }}
                            </option>
                        @endforeach
                    </x-native-select>

                    <x-native-select label="Pilih SKPD" wire:model.live="skpdId" wire:loading.attr='disabled'
                        wire:target="file,import">
                        <option value="" selected disabled>Pilih SKPD</option>
                        @foreach ($skpds as $key => $skpd)
                            <option value="{{ $skpd->id }}">
                                {{ $skpd->kode }} {{ $skpd->nama }}
                            </option>
                        @endforeach
                    </x-native-select>

                    <x-input wire:model="file" label="Upload File" type="file" accept=".xls,.xlsx,.csv"
                        wire:loading.attr='disabled' wire:target="file,import" />
                    <div wire:loading wire:target="file">
                        <x-loading message="Mengupload file..." />
                    </div>
                </div>

                <x-slot name="footer">
                    @if (!$importing)
                        <div class="flex items-center justify-between">
                            <x-button flat secodary label="Kembali" href="{{ route('jadwal-penganggaran.list') }}"
                                wire:loading.attr='disabled' wire:target="file,import" />

                            <x-button type="submit" label="Import Data" primary spinner="import"
                                wire:loading.attr='disabled' wire:target="file,import" />
                        </div>
                    @endif

                    @if ($importing && !$importFinished)
                        <div wire:poll="updateImportProgress">
                            <div class="px-4 py-2 bg-blue-100 border border-blue-600 rounded-md">
                                Melakukan proses import data...
                            </div>
                        </div>
                    @endif

                    @if ($importFinished)
                        <div class="px-4 py-2 bg-green-100 border border-green-600 rounded-md">
                            Import data selesai.
                        </div>
                    @endif
                </x-slot>
            </x-card>
        </form>
    </div>
</div>
