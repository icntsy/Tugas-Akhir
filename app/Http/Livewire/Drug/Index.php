<?php

namespace App\Http\Livewire\Drug;

use App\Exports\DrugExport;
use App\Models\Drug;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $queryString = ['search'];

    protected $listeners = ['articleDeleted', 'drugCreated', 'drugImported'];
    public $sortType;
    public $sortColumn;

    public function articleDeleted()
    {
    }

    public function importData()
    {
        $this->dispatchBrowserEvent('show-model', ['id' => 'modal']);
    }

    public function downloadData()
    {
        return Excel::download(new DrugExport, 'data-obat.xlsx');
    }
    public function drugCreated()
    {
        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('Created Message', ['name' => __('Article')])]);
    }
    public function drugImported()
    {
        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => 'Data Obat Berhasil Di Import']);
    }

    public function sort($column)
    {
        $sort = $this->sortType == 'asc' ? 'desc' : 'asc';
        $this->sortColumn = $column;
        $this->sortType = $sort;
    }

    public function render()
    {
        $drugs = Drug::query();
        $drugs->where('nama', 'like', '%' . $this->search . '%')
        ->orWhere('harga', 'like', '%'.$this->search.'%');
        if ($this->sortColumn) {
            $drugs->orderBy($this->sortColumn, $this->sortType);
        } else {
            $drugs->orderBy('stok', 'asc');
        }
        $drugs = $drugs->paginate(10);

        return view('livewire.drug.index', ['drugs' => $drugs]);
    }
}
