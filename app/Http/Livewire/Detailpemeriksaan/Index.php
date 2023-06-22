<?php

namespace App\Http\Livewire\Detailpemeriksaan;

use App\Models\Familyplanning;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $listeners = ['patientDeleted'];
    protected $paginationTheme = 'bootstrap';
    public $sortType;
    public $sortColumn;

        /**
        * @var mixed
        */
        public $search;

        /**
        * Get the view / contents that represent the component.
        *
        * @return \Illuminate\View\View|string
        */
        public function render()
        {

            $familyplannings = Familyplanning::query();
            $familyplannings->where('name', 'like', '%'.$this->search.'%')
            ->orWhere('age', 'like', '%'.$this->search.'%')
            ->orWhere('address', 'like', '%'.$this->search.'%')
            ->orWhere('entry_date', 'like', '%'.$this->search.'%')
            ->orWhere('husbands_name', 'like', '%'.$this->search.'%');
            if($this->sortColumn){
                $familyplannings->orderBy($this->sortColumn, $this->sortType);
            }else{
                $familyplannings->latest('id');
            }
            $familyplannings = $familyplannings->paginate(10);
            return view('livewire.detailpemeriksaan.index',['familyplannings' => $familyplannings]);
        }
    }
