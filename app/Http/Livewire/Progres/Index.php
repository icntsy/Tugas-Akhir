<?php

namespace App\Http\Livewire\Progres;

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
        $queues = $queues->where("has_check", 1)->where("jenis_rawat", "Inap")->where("doctor_id", Auth::user()->id)->paginate(5);

        return view("livewire.progres.index", compact("queues"));
    }
}
