<?php

namespace App\Livewire\Referensi\SumberDana;

use App\Livewire\Forms\Referensi\SumberSana\SumberDanaForm;
use App\Livewire\LivewireComponent;
use App\Models\SumberDana;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

class SumberDanaList extends LivewireComponent
{
    use WithPagination;

    public SumberDanaForm $form;
    public $showConfirmDialog = false;

    public function mount(): void
    {
        $this->perPage = 20;
    }

    public function updatedSearchKeyword()
    {
        $this->resetPage();
    }

    public function save()
    {
        try {
            DB::beginTransaction();
            $this->form->store();
            DB::commit();
            $this->notification()->success('Berhasil', 'Sumber dana tersimpan.');
            $this->form->reset();
            $this->form->formSumberDana = false;
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->notification()->error('Gagal!', 'Terjadi kesalahan saat menyimpan data, ' . $th->getMessage());
        }
    }

    public function edit($sumberDana)
    {
        $this->form->jenis = $sumberDana['jenis'];
        $this->form->kode = $sumberDana['kode'];
        $this->form->nama = $sumberDana['nama'];
        $this->form->selectedId = $sumberDana['id'];
        $this->form->formAction = 'UPDATE';
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            SumberDana::find($id)->delete();
            DB::commit();
            $this->showConfirmDialog = false;
            $this->notification()->success('Berhasil', 'Sumber dana terhapus.');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->notification()->error('Gagal!', 'Terjadi kesalahan saat menghapus sumber dana, ' . $th->getMessage());
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $sumberDanas = SumberDana::query()
            ->onlySetInput()
            ->search($this->searchKeyword)
            ->orderBy('kode')
            ->paginate($this->perPage);
        return view('livewire.referensi.sumber-dana.sumber-dana-list', [
            'sumberDanas' => $sumberDanas
        ]);
    }
}
