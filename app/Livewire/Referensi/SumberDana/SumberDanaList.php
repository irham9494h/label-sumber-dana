<?php

namespace App\Livewire\Referensi\SumberDana;

use App\Livewire\LivewireComponent;
use App\Models\SumberDana;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;

class SumberDanaList extends LivewireComponent
{
    public $searchKeyword = '';

    public function mount(): void
    {
        $this->perPage = 20;
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            SumberDana::find($id)->delete();
            DB::commit();
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
            ->orderBy('kode')
            ->paginate($this->perPage);
        return view('livewire.referensi.sumber-dana.sumber-dana-list', [
            'sumberDanas' => $sumberDanas
        ]);
    }
}
