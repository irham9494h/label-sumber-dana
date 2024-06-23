<?php

namespace App\Livewire\Forms\Referensi\SumberSana;

use App\Models\SumberDana;
use Illuminate\Validation\Rule;
use Livewire\Form;

class SumberDanaForm extends Form
{
    public $formSumberDana = false;
    public $selectedId = null;
    public $formAction = 'CREATE';

    public $kode = '';
    public $nama = '';
    public $jenis = '';

    public function updatedFormSumberDana()
    {
        dd($this->formAction);
    }

    public function rules()
    {
        return [
            'kode' => ['required', Rule::unique(SumberDana::TABLE, 'kode')->ignore($this->selectedId, 'id')],
            'nama' => 'required',
            'jenis' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'kode.required' => 'Kode sumber dana tidak boleh kosong.',
            'kode.unique' => 'Kode sumber dana sudah digunakan.',
            'nama.required' => 'Nama sumber dana tidak boleh kosong.',
            'jenis.required' => 'Pilih salah satu jenis sumber dana.'
        ];
    }

    public function store()
    {
        $this->validate();
        SumberDana::create([
            'jenis' => $this->jenis,
            'kode' => $this->kode,
            'nama' => $this->nama
        ]);
    }

    public function update()
    {
        $this->validate();
        SumberDana::find($this->selectedId)->update([
            'jenis' => $this->jenis,
            'kode' => $this->kode,
            'nama' => $this->nama
        ]);
    }
}
