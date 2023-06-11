<?php

namespace App\Http\Livewire\Diagnosis;

use App\Models\Diagnosis;
use Livewire\Component;

class Single extends Component
{
    public $diagnosis;
    public $diagnosisIndex;

    public function mount(Diagnosis $diagnosis, $diagnosisIndex){
        $this->diagnosis = $diagnosis;
        $this->diagnosisIndex = $diagnosisIndex;
    }
    public function render()
    {
        return view('livewire.diagnosis.single');
    }

    public function delete(){
        $this->diagnosis->delete();
        $this->emit('diagnosisDeleted');
    }
}
