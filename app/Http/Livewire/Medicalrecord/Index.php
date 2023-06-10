<?php

namespace App\Http\Livewire\MedicalRecord;

use App\Models\MedicalRecord;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;


class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];

    public $search;
    public $sortType;
    public $sortColumn;

    protected $listeners  = [
        'labDeleted'
    ];

    public function sort($column)
    {
        $sort = $this->sortType == 'desc' ? 'asc' : 'desc';
        $this->sortColumn = $column;
        $this->sortType = $sort;
    }

    public function render()
    {
        $records = MedicalRecord::query()->where('id', 'like', '%' . $this->search . '%');
        $records -> orWhere('id', 'like', '%'.$this->search.'%')
        ->orWhereHas('drugs', function($query) {
            $query->where('nama', 'like', '%' . $this->search . '%');
        })
        ->orWhereHas('labs', function($query) {
            $query->where('nama', 'like', '%' . $this->search . '%');
        })
        ->orWhereHas('diagnoses', function($query) {
            $query->where('indonesian_name', 'like', '%' . $this->search . '%');
        })
        ->orWhereHas('patient', function($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })
        ->orWhereHas('patient', function($query) {
            $query->where('no_rekam_medis', 'like', '%' . $this->search . '%');
        })
        ->orWhere('main_complaint', 'like', '%' . $this->search . '%');
        if ($this->sortColumn) {
            $records->orderBy($this->sortColumn, $this->sortType);
        } else {
            $records->latest('id');
        }
        $records = $records->paginate(5);

        // if (Auth::user()->role == "admin") {
        //     $records = $records->paginate(5);
        //    } else {
        //     $records = $records->where("doctor_id", Auth::user()->id)->paginate(5);
        //    }
        return view('livewire.medicalrecord.index', compact('records'));
    }
}
