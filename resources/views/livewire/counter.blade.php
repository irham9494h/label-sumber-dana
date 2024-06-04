<?php

use App\Livewire\Forms\Jadwal\FormJadwalPenganggaran;
use function Livewire\Volt\{form};

form(FormJadwalPenganggaran::class);

$save = function () {
    $this->form->validate();
    dd($this->form);
};

?>

<form wire:submit="save">
    <input type="text" wire:model="form.title">
    @error('form.title')
        <span class="error">{{ $message }}</span>
    @enderror

    <button type="submit">Save</button>
</form>
