<?php

namespace App\Jobs;

use App\Models\AkunRekening;
use App\Models\Belanja;
use App\Models\BidangUrusan;
use App\Models\BidangUrusanUnitSkpd;
use App\Models\Kegiatan;
use App\Models\KelompokStandarHarga;
use App\Models\Program;
use App\Models\RincianBelanja;
use App\Models\StandarHarga;
use App\Models\SubKegiatan;
use App\Models\SumberDana;
use App\Models\UnitSkpd;
use App\Models\Urusan;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class ImportDataBelanja implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private $belanjas, private $jadwalPenganggaranId, private $skpdId)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->belanjas as $key => $belanja) {
            $unitSkpd = UnitSkpd::firstOrCreate([
                'skpd_id' => $this->skpdId,
                'kode' => str($belanja['KODE UNIT SKPD']),
            ], [
                'nama' => str($belanja['NAMA UNIT SKPD'])->limit(255),
            ]);

            $urusan = Urusan::firstOrCreate([
                'kode' => str($belanja['KODE URUSAN']),
            ], [
                'nama' => str($belanja['NAMA URUSAN'])->limit(255),
            ]);

            $bidangUrusan = BidangUrusan::firstOrCreate([
                'urusan_id' => $urusan->id,
                'kode' => str($belanja['KODE BIDANG URUSAN']),
            ], [
                'nama' => str($belanja['NAMA BIDANG URUSAN'])->limit(255),
            ]);

            $bidangUrusanUnitSkpd = BidangUrusanUnitSkpd::firstOrCreate([
                'bidang_urusan_id' => $bidangUrusan->id,
                'unit_skpd_id' => $unitSkpd->id,
            ]);

            $program = Program::firstOrCreate(['kode' => str($belanja['KODE PROGRAM']), 'bidang_urusan_id' => $bidangUrusan->id], [
                'nama' => str($belanja['NAMA PROGRAM'])->limit(255),
            ]);

            $kegiatan = Kegiatan::firstOrCreate([
                'program_id' => $program->id,
                'kode' => str($belanja['KODE KEGIATAN']),
            ], [
                'nama' => str($belanja['NAMA KEGIATAN'])->limit(255),
            ]);

            $subKegiatan = SubKegiatan::firstOrCreate([
                'kegiatan_id' => $kegiatan->id,
                'kode' => str($belanja['KODE SUB KEGIATAN']),
            ], [
                'nama' => str($belanja['NAMA SUB KEGIATAN'])->limit(255),
            ]);


            $akun = AkunRekening::firstOrCreate([
                'kode' => str($belanja['KODE AKUN']),
                'jenis_akun' => AkunRekening::SUB_RINCIAN_OBJEK
            ], [
                'nama' => str($belanja['NAMA AKUN'])->limit(255),
            ]);

            $kelompokStandarHarga = KelompokStandarHarga::firstOrCreate([
                'kode' => str($belanja['KODE STANDAR HARGA'])->substr(0, 17),
            ], [
                'nama' => str($belanja['NAMA STANDAR HARGA'])->limit(255),
            ]);

            $standarHarga = StandarHarga::firstOrCreate([
                'kel_standar_harga_id' => $kelompokStandarHarga->id,
                'kode' => str($belanja['KODE STANDAR HARGA']),
            ], [
                'nama' => str($belanja['NAMA STANDAR HARGA'])->limit(255),
                'spek' => str($belanja['SPESIFIKASI'])->limit(255),
            ]);

            $dataBelanja = Belanja::firstOrCreate([
                'jadwal_penganggaran_id' => $this->jadwalPenganggaranId,
                'unit_skpd_id' => $unitSkpd->id,
                'bidang_urusan_id' => $bidangUrusan->id,
                'sub_kegiatan_id' => $subKegiatan->id,
            ]);

            $sumberDana = SumberDana::where('nama', $belanja['SUMBER DANA'])
                ->first();

            $rincianBelanja = RincianBelanja::create([
                'belanja_id' => $dataBelanja->id,
                'akun_id' => $akun->id,
                'standar_harga_id' => $standarHarga->id,
                'kelompok' => !empty($belanja['PAKET/KELOMPOK BELANJA']) ? str($belanja['PAKET/KELOMPOK BELANJA'])->limit(255) : '',
                'keterangan' => !empty($belanja['KETERANGAN BELANJA']) ? str($belanja['KETERANGAN BELANJA'])->limit(255) : '',
                'sumber_dana_id' => $sumberDana ? $sumberDana->id : null,
                'nama_penerima_bantuan' => !empty($belanja['NAMA PENERIMA BANTUAN']) ? str($belanja['NAMA PENERIMA BANTUAN'])->limit(255) : '',
                'koefisien_murni' => !empty($belanja['KOEFISIEN MURNI']) ? str($belanja['KOEFISIEN MURNI'])->limit(255) : '',
                'harga_satuan_murni' => !empty($belanja['HARGA SATUAN MURNI']) ? $belanja['HARGA SATUAN MURNI'] :  0,
                'total_harga_murni' => !empty($belanja['TOTAL HARGA MURNI']) ? $belanja['TOTAL HARGA MURNI'] :  0,
                'koefisien' => !empty($belanja['KOEFISIEN']) ? str($belanja['KOEFISIEN'])->limit(255) : '',
                'harga_satuan' => !empty($belanja['HARGA SATUAN']) ? $belanja['HARGA SATUAN'] :  0,
                'total_harga' => !empty($belanja['TOTAL HARGA']) ? $belanja['TOTAL HARGA'] : 0,
            ]);
        }
    }
}
