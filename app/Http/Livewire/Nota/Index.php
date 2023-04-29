<?php

namespace App\Http\Livewire\Nota;

use App\Exports\TransactionExport;
use App\Models\Transaction;
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

    protected $listeners = ['articleDeleted', 'drugCreated'];
    public $sortType;
    public $sortColumn;

    public function downloadData()
    {
        return Excel::download(new TransactionExport, 'nota-data.xlsx');
    }
    public function drugCreated()
    {
        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('Created Message', ['name' => __('Article')])]);
    }

    public function sort($column)
    {
        $sort = $this->sortType == 'asc' ? 'desc' : 'asc';
        $this->sortColumn = $column;
        $this->sortType = $sort;
    }

    public function render()
    {
        $transaksi = Transaction::query();
        $transaksi->where('payment', 'like', '%' . $this->search . '%');
        if ($this->sortColumn) {
            $transaksi->orderBy($this->sortColumn, $this->sortType);
        } else {
            $transaksi->orderBy('id', 'asc');
        }
        $transaksi = $transaksi->paginate(5);

        return view('livewire.nota.index', ['transaksi' => $transaksi]);
    }
}
