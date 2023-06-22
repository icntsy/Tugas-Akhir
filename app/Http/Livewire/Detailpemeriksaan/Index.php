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
            // $patients = Patient::query();
            // $patients->where('name', 'like', '%'.$this->search.'%')
            // ->orWhere('nik', 'like', '%'.$this->search.'%')
            // ->orWhere('gender', 'like', '%'.$this->search.'%')
            // ->orWhere('address', 'like', '%'.$this->search.'%')
            // ->orWhere('blood_type', 'like', '%'.$this->search.'%')
            // ->orWhere('no_rekam_medis', 'like', '%'.$this->search.'%')
            // ->orWhere('phone_number', 'like', '%'.$this->search.'%');

            // if($this->sortColumn){
            //     $patients->orderBy($this->sortColumn, $this->sortType);
            // }else{
            //     $patients->latest('id');
            // }
            // $patients = $patients->paginate(10);
            // return view('livewire.detailpemeriksaan.index');
            // return view('livewire.detailpemeriksaan.index', compact('patients'));
        }
    }
