<?php

namespace App\Http\Livewire\Detailpemeriksaan;

use App\Models\Patient;
use App\Models\Queue;
use Livewire\Component;
use Carbon\Carbon;

class Data extends Component
{
    public $value;
    public $valueIndex;

    public function mount(Queue $value, $valueIndex){
        $this->value = $value;
        $this->valueIndex = $valueIndex;
    }

    public function detail(){
        $this->redirectRoute('detailpatient.process', ['patient' => $this->patient->id]);
    }

    /**
    * Get the view / contents that represent the component.
    *
    * @return \Illuminate\View\View|string
    */
    public function render()
    {
        return view('livewire.detailpatient.data');
    }

    public function historydetail()
    {
        if ($this->value->jenis_rawat == "Inap") {
            $this->redirectRoute("progres.history", ["queue" => $this->value]);
        } else if ($this->value->jenis_rawat == "Jalan") {
            $this->redirectRoute("jalan.history", ["queue" => $this->value]);
        }
    }
}
