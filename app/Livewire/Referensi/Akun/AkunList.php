<?php

namespace App\Livewire\Referensi\Akun;

use App\Livewire\LivewireComponent;
use App\Models\AkunRekening;
use Illuminate\Http\Request;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

class AkunList extends LivewireComponent
{
    use WithPagination;

    public function updatedSearchKeyword()
    {
        $this->resetPage();
    }

    #[Layout('layouts.app')]
    public function render(Request $request)
    {
        $akuns = AkunRekening::query()
            ->search($this->searchKeyword)
            ->orderBy('kode')
            ->paginate($this->perPage);

        return view('livewire.referensi.akun.akun-list', [
            'akuns' => $akuns
        ]);
    }
}
