<?php

namespace App\Http\Livewire\Drug;

use App\Models\Queue;
use Livewire\Component;

class Process extends Component
{
    public $queue;

    public  function mount(Queue $queue){
        $this->queue = $queue;
    }

    public function save()
    {
        // TODO:: Create invoice print function before update!!
        try {
            $this->queue->update([
                "has_drug" => true
            ]);
            $this->redirectRoute('queue.drug');
        } catch (\Exception $e) {
            dd($e);
        }
    }
    public function render()
    {
        return view('livewire.drug.process');
    }
}
