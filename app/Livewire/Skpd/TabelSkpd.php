<?php

namespace App\Livewire\Skpd;

use Livewire\Attributes\Layout;
use Livewire\Component;

class TabelSkpd extends Component
{
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.skpd.tabel-skpd');
    }
}
