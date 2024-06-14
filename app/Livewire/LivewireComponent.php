<?php

namespace App\Livewire;

use Livewire\Component;
use WireUi\Traits\Actions;

class LivewireComponent extends Component
{
    use Actions;

    public $perPage = 10;
    public $searchKeyword = '';
}
