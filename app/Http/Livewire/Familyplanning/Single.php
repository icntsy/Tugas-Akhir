<?php

namespace App\Http\Livewire\Familyplanning;

use App\Models\Familyplanning;
use Livewire\Component;

class Single extends Component
{
    public $familyplanning;
    public $familyplanningIndex;

    public function mount(Familyplanning $familyplanning, $familyplanningIndex){
        $this->familyplanning = $familyplanning;
        $this->familyplanningIndex = $familyplanningIndex;
    }

    public function delete(){
        $this->familyplanning->delete();
        $this->emit('familyplanningDeleted');
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */

    public function render()
    {
        return view('livewire.familyplanning.single');
    }

}
