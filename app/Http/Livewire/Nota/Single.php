<?php

namespace App\Http\Livewire\Nota;

use App\Models\Transaction;
use Livewire\Component;

class Single extends Component
{
    public $transaksi;
    public $available;


    public function mount(Transaction $transaksi){
        $this->transaksi = $transaksi;

        // $this->available = $drug->min_stok < $drug->stok;
    }

    public function render()
    {
        return view('livewire.nota.single');
    }

    public function delete(){
        $this->drug->delete();
        $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => __('Obat Terhapus', ['name' => __('Article') ]) ]);
        $this->emit('articleDeleted');
    }
}
