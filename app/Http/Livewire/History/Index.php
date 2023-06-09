<?php

namespace App\Http\Livewire\History;

use App\Models\Gravida;
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
        $gravida = Gravida::query()->where('id', 'like', '%' . $this->search . '%');
        if ($this->sortColumn) {
            $gravida->orderBy($this->sortColumn, $this->sortType);
        } else {
            $gravida->latest('id');
        }

        $gravida = $gravida->where("bidan_id", Auth::user()->id)->paginate(7);

        // if (Auth::user()->role == "admin") {
        //     $records = $records->paginate(5);
        //    } else {
        //     $records = $records->where("doctor_id", Auth::user()->id)->paginate(5);
        //    }

        return view('livewire.History.index', compact('gravida'));
    }
}
