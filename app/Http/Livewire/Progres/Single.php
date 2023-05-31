<?php

namespace App\Http\Livewire\Progres;

use App\Models\Queue;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Single extends Component
{
    public $queue;
    public $role; // Tambahkan properti $role

    public function mount(Queue $queue){
        $this->queue = $queue;
        $this->role = Auth::user()->role; // Inisialisasi $role
    }

    public function delete(){
        $this->queue->delete();
        $this->emit('queueDeleted');
    }
    public function render()
    {
        return view('livewire.progres.single', [
            'role' => $this->role // Mengirimkan $role ke tampilan
        ]);
    }

    public function processCheckup(){
        return view("livewire.progres.process", [
            'queue' => $this->queue
        ]);
    }

    public function processDrug(){
        $this->redirectRoute('queue.drug.process', ['queue' => $this->queue->id]);
    }
}
