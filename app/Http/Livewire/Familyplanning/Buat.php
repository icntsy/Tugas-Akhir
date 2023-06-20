<?php

namespace App\Http\Livewire\Familyplanning;

use App\Models\FamilyPlanningExamination;
use Livewire\Component;

class Buat extends Component
{
    public $arrival_date;
    public $body_weight;
    public $blood_pressure;
    public $return_date;


    protected $rules = [
        'arrival_date' => 'required',
        'body_weight' => 'required',
        'blood_pressure' => 'required',
        'return_date' => 'required',

    ];

    public function create()
    {
        $this->validate();

        FamilyPlanningExamination::create([
            'arrival_date' => $this->arrival_date,
            'body_weight' => $this->body_weight,
            'blood_pressure' => $this->blood_pressure,
            'return_date' => $this->return_date,
        ]);
        $this->dispatchBrowserEvent('show-message', [
            'type' => 'success',
            'message' => 'Sukses Menambah Data Pemeriksaan KB'
        ]);

        return redirect()->route('familyplanning.index');

       // $this->redirectRoute('familyplanning.index');
    }

    public function render()
    {
        return view('livewire.familyplanning.buat');
    }
}
