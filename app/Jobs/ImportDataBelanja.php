<?php

namespace App\Jobs;

use App\Models\Belanja;
use App\Models\BidangUrusan;
use App\Models\BidangUrusanUnitSkpd;
use App\Models\Kegiatan;
use App\Models\Program;
use App\Models\SubKegiatan;
use App\Models\UnitSkpd;
use App\Models\Urusan;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

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
        // try {
        //     DB::beginTransaction();
        foreach ($this->belanjas as $key => $belanja) {
            $unitSkpd = UnitSkpd::firstOrCreate([
                'skpd_id' => $this->skpdId,
                'kode' => str($belanja['KODE SKPD']),
            ], [
                'nama' => str($belanja['NAMA SKPD'])->limit(255),
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


            $program = Program::firstOrCreate([
                'kode' => str($belanja['KODE PROGRAM']),
            ], [
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

            $newBelanja = Belanja::create([
                'jadwal_penganggaran_id' => $this->jadwalPenganggaranId,
                'unit_skpd_id' => $unitSkpd->id,
                'bidang_urusan_id' => $bidangUrusan->id,
                'sub_kegiatan_id' => $subKegiatan->id,
            ]);
        }
        //     DB::commit();
        // } catch (\Throwable $th) {
        //     DB::rollBack();
        // }
    }
}
