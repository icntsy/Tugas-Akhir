<?php

namespace App\Http\Livewire\Detailpemeriksaan;


use App\Models\Familyplanning;
use App\Models\Gravida;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Carbon\Carbon;

class Process extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $familyplanning;
    public $sortType;
    public $sortColumn;

    public  function mount(Familyplanning $familyplanning)
    {
        $this->familyplanning = $familyplanning;
    }

    public function getAge()
    {
        return Carbon::parse($this->familyplanning->age)->age;
    }

    public function render()
{
    $familyPlanningExaminations = $this->familyplanning->familyPlanningExaminations()
        ->orderByDesc('created_at')
        ->paginate(2);

    return view('livewire.detailpemeriksaan.process', [
        "antrian" => $this->familyplanning,
        "familyPlanningExaminations" => $familyPlanningExaminations,
    ]);
}


    // public function render()
    // {

    //     // return view('livewire.detailpemeriksaan.process', [
    //     //     "antrian" => $this->familyplanning,
    //     //     "familyPlanningExaminations" => $this->familyplanning->familyPlanningExaminations()->paginate(10),
    //     // ]);

    //     // $antrian = $this->familyplanning;
    //     // return view('livewire.detailpemeriksaan.process', ["antrian" => $antrian]);

    // }
}
