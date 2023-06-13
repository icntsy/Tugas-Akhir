<?php

namespace App\Http\Livewire\Queue;

use App\Models\Queue;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;




class Drug extends Component
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
            $queues = Queue::query()
            ->where(function($query) {
                $query->where('queue_number', 'like', '%' . $this->search . '%');
                $query->orWhereHas('patient', function($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                    $query->orWhere('jenis_rawat', 'like', '%' . $this->search . '%');
                });
                $query->orWhereHas('doctor', function($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                });
                $query->orWhereHas('service', function($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                });
            });


            // Memeriksa peran pengguna yang sedang login
            $user = Auth::user();
            if ($user && $user->role === 'dokter') {
                $queues->where('jenis_rawat', 'Inap');

            } else {
                $queues->where('jenis_rawat', 'Jalan');

            }

            $queues->whereDate('created_at', Carbon::today())->where('has_check', true)->where('has_drug', false);
            $queues = $queues->paginate(5);

            return view('livewire.queue.drug', compact('queues'));
        }
    }
