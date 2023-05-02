<?php

namespace App\Http\Livewire\Queue;

use App\Models\Queue;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;


class Index extends Component

{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $listeners = [
        'queueDeleted','queueUpdated'
    ];

    public function queueDeleted(){
        $this->dispatchBrowserEvent('show-message',[
            'type' => 'success',
            'message' => 'Data Berhasil dihapus'
        ]);
    }
    public function render()
    {
        $queues = Queue::query();
        $queues->whereDate('created_at', Carbon::today())->where(
            'has_check', false,
        );

        if (Auth::user()->role == "admin") {
            $queues = $queues->paginate(5);
           } else {
            $queues = $queues->where("doctor_id", Auth::user()->id)->paginate(5);
           }
        // $queues = $queues->where("doctor_id", Auth::user()->id)->paginate(5);
         return view('livewire.queue.index', compact('queues'));
    }
}
