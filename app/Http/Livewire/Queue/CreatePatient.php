<?php

namespace App\Http\Livewire\Queue;

use App\Models\Patient;
use Livewire\Component;

class CreatePatient extends Component
{
    public $name;
    public $birth_date;
    public $gender;
    public $address;
    public $phone_number;
    public $study;
    public $blood_type;
    public $profession;
    public $allergy;
    public $nik;

    protected $rules = [
        'name' => 'required',
        'birth_date' => 'required|date',
        'gender' => 'required',
        'address' => 'required',
        'phone_number' => 'required',
        'study' => 'required',
        'blood_type' => 'required',
        'profession' => 'required',
        'allergy' => 'required',
        'nik' => 'required|unique:patients,nik'
    ];

    public function create()
    {
        $this->validate();

        $patient =Patient::create([
            'name' => $this->name,
            'birth_date' => $this->birth_date,
            'gender' => $this->gender,
            'address' => $this->address,
            'phone_number' => $this->phone_number,
            'study' => $this->study,
            'blood_type' => $this->blood_type,
            'profession' => $this->profession,
            'allergy' => $this->allergy,
            'nik' => $this->nik,
        ]);

        $this->emit('patientSelected', $patient->id);
    }
    public function render()
    {
        return view('livewire.queue.create-patient');
    }
}
