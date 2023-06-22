<?php

namespace App\Http\Livewire\Detailpemeriksaan;

use App\Models\Familyplanning;
use Livewire\Component;
use Carbon\Carbon;

class Single extends Component
{
    public $familyplanning;
    public $familyplanningIndex;

    public function mount(Familyplanning $familyplanning, $familyplanningIndex){
        $this->familyplanning = $familyplanning;
        $this->familyplanningIndex = $familyplanningIndex;
    }

    public function getAge()
    {
        return Carbon::parse($this->familyplanning->age)->age;
    }

    public function pemeriksaan(){
        $this->redirectRoute('detailpemeriksaan.process', ['familyplanning' => $this->familyplanning->id]);
    }

    /**
    * Get the view / contents that represent the component.
    *
    * @return \Illuminate\View\View|string
    */
    public function render()
    {
        return view('livewire.detailpemeriksaan.single');
    }
}
