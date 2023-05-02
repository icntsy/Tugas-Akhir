<?php

namespace App\Http\Livewire\MedicalRecord;

use App\Models\MedicalRecord;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

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
        if ($this->sortColumn) {
            $records->orderBy($this->sortColumn, $this->sortType);
        } else {
            $records->latest('id');
        }
        $records = $records->paginate(5);

        return view('livewire.medicalrecord.index', compact('records'));
    }
}
