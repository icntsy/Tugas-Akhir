<?php

namespace App\Http\Livewire\Jalan;

use App\Models\Queue;
use Livewire\Component;
use App\Models\MedicalRecordStatus;
use Illuminate\Support\Facades\Auth;

class Single extends Component
{
    public $queue;
    public $role; // Tambahkan properti $role
    public $progresIndex;

    public function mount(Queue $queue, $progresIndex){
        $this->queue = $queue;
        $this->progresIndex = $progresIndex;
        $this->role = Auth::user()->role; // Inisialisasi $role
    }

    public function delete(){
        $this->queue->delete();
        $this->emit('queueDeleted');
    }
    public function render()
    {
        return view('livewire.jalan.single', [
            'role' => $this->role // Mengirimkan $role ke tampilan
        ]);
    }

    public function processCheckup(){
        // return view("livewire.progres.process", [
        //     'queue' => $this->queue
        //     ]);
        $this->redirectRoute('progres.process', ['queue' => $this->queue->id]);
    }

    public function processDrug(){
    }
    public function selesai()
    {
        // MedicalRecordStatus::create([
        //     "medical_record_inap" => $this->queue->medical_record_id,
        //     "status" => 1
        // ]);
        $this->redirectRoute("progres.selesai", ["queue" => $this->queue]);
        // return redirect("/progres");
    }
    public function history() {
        $this->redirectRoute("jalan.history", ["queue" => $this->queue]);
    }

    public function pulang()
    {
        $this->redirectRoute("progres.pulang", ["queue" => $this->queue]);
    }
}
