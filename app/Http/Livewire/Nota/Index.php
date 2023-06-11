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
        return Excel::download(new TransactionExport, 'data-nota.xlsx');
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
        $transaksi = Transaction::query()
        ->where('payment', 'like', '%' . $this->search . '%')
        ->orWhere('id', 'like', '%'.$this->search.'%')
        ->orWhereHas('queue.patient', function($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })
        ->orWhereHas('queue.patient', function($query) {
            $query->where('jenis_rawat', 'like', '%' . $this->search . '%');
        })
        ->with('queue.patient')
        ->orWhereHas('queue.doctor', function($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })
        ->with('queue.patient')
        ->orWhereHas('queue.service', function($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })

        ->with('queue.service')
        ->orWhereHas('queue.medicalrecord', function($query) {
            $query->where('created_at', 'like', '%' . $this->search . '%');
        })
        ->with('queue.medicalrecord')
        ->orWhereHas('queue.medicalrecord.medicalRecordDrugs.Drugs', function($query) {
            $query->where('nama', 'like', '%' . $this->search . '%');
        })
        ;


        if ($this->sortColumn) {
            $transaksi->orderBy($this->sortColumn, $this->sortType);
        } else {
            $transaksi->orderBy('id', 'desc');
        }
        $transaksi = $transaksi->paginate(5);

        return view('livewire.nota.index', ['transaksi' => $transaksi]);
    }
}
