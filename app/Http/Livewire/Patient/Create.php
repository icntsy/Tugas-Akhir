<?php

namespace App\Http\Livewire\Patient;

use App\Models\Patient;
use Carbon\Carbon;
use Livewire\Component;

class Create extends Component
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
        'study' => 'required',
        'profession' => 'required',
        'blood_type' => 'required',
        'nik' => 'required|unique:patients,nik'
    ];

    public function create()
    {
        $this->validate();

        Patient::create([
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

        $this->dispatchBrowserEvent('show-message', [
            'type' => 'success',
            'message' => 'Sukses Menambah Data Pasien'
        ]);
        $this->redirectRoute('patient.index');
    }

    public function render()
    {
        return view('livewire.patient.create');
    }
}
