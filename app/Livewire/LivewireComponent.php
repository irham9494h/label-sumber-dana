<?php

namespace App\Livewire;

use Livewire\Component;


class LivewireComponent extends Component
{


    public $perPage = 20;
    public $searchKeyword = '';

    public $showFilter = false;
    public $filledFilter = [];

    public function addFilledFilterAttr(string $attr)
    {
        if (!in_array($attr, $this->filledFilter)) {
            array_push($this->filledFilter, $attr);
        }
    }

    public function removeFilledFilterAttr(string $attr)
    {
        if (($key = array_search($attr, $this->filledFilter)) !== false) {
            unset($this->filledFilter[$key]);
        }
    }

    public function clearFilledFilterAttr()
    {
        $this->showFilter = false;
        $this->filledFilter = [];
    }
}
