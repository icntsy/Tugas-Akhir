<?php

namespace App\Http\Livewire\Familyplanning;

use App\Models\Familyplanning;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public $age;
    public $address;
    public $husbands_name;
    public $entry_date;

    protected $rules = [
        'name' => 'required',
        'age' => 'required',
        'address' => 'required',
        'husbands_name' => 'required',
        'entry_date' => 'required',
    ];

    public function create()
    {
        $this->validate();

        Familyplanning::create([
            'name' => $this->name,
            'age' => $this->age,
            'address' => $this->address,
            'husbands_name' => $this->husbands_name,
            'entry_date' => $this->entry_date,
        ]);
        $this->dispatchBrowserEvent('show-message', [
            'type' => 'success',
            'message' => 'Sukses Menambah Data KB'
        ]);

        $this->redirectRoute('familyplanning.index');
    }

    public function render()
    {
        return view('livewire.familyplanning.create');
    }
}
