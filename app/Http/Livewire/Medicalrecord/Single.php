<?php

namespace App\Http\Livewire\MedicalRecord;

use App\Models\MedicalRecord;
use Livewire\Component;

class Single extends Component
{
    public $record;
    public $available;

    public function mount(MedicalRecord $record){
        $this->record = $record;
    }

    public function render()
    {
        $record = $this->record;
        return view('livewire.medicalrecord.single', compact("record"));
    }
}
