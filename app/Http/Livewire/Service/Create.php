<?php

namespace App\Http\Livewire\Service;

use App\Models\Service;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public $status;
    
    public function rules(){
        return [
            'name' => 'required|unique:services,name',
            'status' => 'required'
        ];
    }

    public function create(){
        $this->validate();
        Service::create([
            'name' => $this->name,
            'status' => $this->status
            ]);
            $this->dispatchBrowserEvent('show-message', [
                'type' => 'success',
                'message' => 'Sukses Menambah Data Layanan'
                ]);

                $this->redirectRoute('service.index');
            }

            public function render()
            {
                return view('livewire.service.create');
            }
        }
