<div>

    @push('header')
        <x-layouts.header title="Upload Data Sumber Dana" />
    @endpush

    <div>
        <form>
            <x-card shadow="shadow-sm">
                <div class="space-y-3">
                    <x-native-select label="Pilih Jadwal Penganggaran SIPD" wire:model="jadwalPenganggaranId">
                        <option value="" selected disabled>Pilih Jadwal</option>
                        @foreach ($jadwalPenganggarans as $key => $jadwal)
                            <option value="{{ $jadwal->id }}">
                                {{ $jadwal->tahapan->nama }} - {{ $jadwal->nama_sub_tahapan }}
                            </option>
                        @endforeach
                    </x-native-select>

                    <x-native-select label="Pilih SKPD" wire:model.live="skpdId">
                        <option value="" selected disabled>Skpd</option>
                        @foreach ($skpds as $key => $skpd)
                            <option value="{{ $skpd->id }}">
                                {{ $skpd->kode }} {{ $skpd->nama }}
                            </option>
                        @endforeach
                    </x-native-select>

                    <div wire:loading wire:target='skpdId'>
                        <x-loading message="Loading data Unit SKPD..." />
                    </div>

                    <x-native-select label="Pilih Unit SKPD" wire:model.live="unitSkpdId">
                        <option value="" selected disabled>Unit Skpd</option>
                        @foreach ($unitSkpds as $key => $unitSkpd)
                            <option value="{{ $unitSkpd->id }}">
                                {{ $unitSkpd->kode }} {{ $unitSkpd->nama }}
                            </option>
                        @endforeach
                    </x-native-select>

                    <x-input wire:model="file" label="Upload File" type="file" accept=".xls,.xlsx,.csv" />
                </div>

                <x-slot name="footer">
                    <div class="flex items-center justify-between">
                        <x-button flat secodary label="Kembali" href="{{ route('jadwal-penganggaran.list') }}" />
                        <x-button type="submit" label="Simpan" primary spinner="import" />
                    </div>
                </x-slot>
            </x-card>
        </form>
    </div>
</div>
