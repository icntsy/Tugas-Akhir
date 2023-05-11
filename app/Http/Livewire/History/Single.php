<?php

namespace App\Http\Livewire\History;

use App\Models\Gravida;
use Livewire\Component;

class Single extends Component
{
    public $gravida;
    public $available;

    public function mount(Gravida $gravida){
        $this->gravida = $gravida;
    }

    public function render()
    {
        $record = $this->gravida;
        return view('livewire.History.single', compact("record"));
    }
}
