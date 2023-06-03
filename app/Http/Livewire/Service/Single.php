<?php

namespace App\Http\Livewire\Service;

use App\Models\Service;
use Livewire\Component;

class Single extends Component
{

    public $service;
    public $serviceIndex;

    public function delete(){
        $this->service->delete();
        $this->emit('serviceDeleted');

    }

    public function mount(Service $service, $serviceIndex){
        $this->service = $service;
        $this->serviceIndex = $serviceIndex;

    }
    public function render()
    {
        return view('livewire.service.single');
    }
}
