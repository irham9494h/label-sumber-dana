<?php

namespace App\Livewire\Belanja;

use App\Jobs\ImportDataBelanja;
use App\Models\JadwalPenganggaran;
use App\Models\Skpd;
use Illuminate\Support\Facades\Bus;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;
use Livewire\Attributes\Validate;
use Spatie\SimpleExcel\SimpleExcelReader;

class ImportData extends Component
{
    use Actions;
    use WithFileUploads;

    #[Validate('required', message: 'Anda belum memilih jadwal penganggaran.')]
    public $jadwalPenganggaranId = '';

    #[Validate('required', message: 'Anda belum memilih SKPD')]
    public $skpdId = '';

    #[Validate('required', message: 'Anda belum memilih file import.')]
    #[Validate('mimes:xls,xlsx,csv', message: 'Format file tidak sesuai, gunakan file .xls, .xlsx atau csv.')]
    #[Validate('max:2000', message: 'Ukuran file terlalu besar, maksimal 2MB.')]
    public $file;

    public $jadwalPenganggarans = [];
    public $skpds = [];

    public $importing = false;
    public $importFinished = false;
    public $batchId;
    public $importFilePath;

    public function mount()
    {
        $this->jadwalPenganggarans = $this->fetchJadwalPenganggaran();
        $this->skpds = $this->fetchSkpd();
    }

    public function fetchJadwalPenganggaran()
    {
        return JadwalPenganggaran::query()
            ->where('tahun', cache()->get('tahun'))
            ->latest()
            ->get();
    }

    public function fetchSkpd()
    {
        return Skpd::query()
            ->orderBy('kode')
            ->get();
    }

    public function import()
    {
        $this->validate();

        $this->importing = true;
        $this->importFilePath = $this->file->path();

        $belanjaRows = SimpleExcelReader::create($this->importFilePath)
            ->headerOnRow(0)
            ->getRows();

        $batch = Bus::batch([
            new ImportDataBelanja($belanjaRows->toArray(), $this->jadwalPenganggaranId, $this->skpdId),
        ])->dispatch();

        $this->batchId = $batch->id;
    }

    public function getImportBatchProperty()
    {
        if (!$this->batchId) return null;
        return Bus::findBatch($this->batchId);
    }

    public function updateImportProgress()
    {
        $this->importFinished = $this->importBatch->finished();

        if ($this->importFinished) {
            $this->importing = false;
            $this->skpdId = '';
            $this->file = '';
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.belanja.import-data');
    }
}
