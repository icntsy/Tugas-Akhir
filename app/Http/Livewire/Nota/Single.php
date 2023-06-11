<?php

namespace App\Http\Livewire\Nota;

use App\Models\Queue;
use App\Models\Transaction;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Single extends Component
{
    public $transaksi;
    public $available;
    public $transaksiIndex;
    public $role;
    public $queue;


    public function mount(Transaction $transaksi, $transaksiIndex){

        $this->transaksi = $transaksi;
        $this->transaksiIndex = $transaksiIndex;
        $this->role = Auth::user()->role; // Inisialisasi $role
        // Mendapatkan $queue dari $transaksi
        $this->queue = $transaksi->queue;
        
        // $this->available = $drug->min_stok < $drug->stok;
    }

    public function render()
    {

        return view('livewire.nota.single', [
            'role' => $this->role // Mengirimkan $role ke tampilan
            ]);
        }

        public function delete(){
            $this->drug->delete();
            $this->dispatchBrowserEvent('show-message', ['type' => 'error', 'message' => __('Obat Terhapus', ['name' => __('Article') ]) ]);
            $this->emit('articleDeleted');
        }
    }
