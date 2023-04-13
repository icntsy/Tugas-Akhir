<?php

namespace App\Http\Livewire\Service;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $search;

    protected $listeners = [
        'serviceDeleted'
    ];

    public function serviceDeleted(){
        $this->dispatchBrowserEvent('show-message', [
            'type' => 'success',
            'message' => 'Berhasil Menghapus Data'
        ]);
    }

    public function render()
    {

        $services = Service::query();
        $services->where('name', 'like', '%' . $this->search . '%');
        $services = $services->paginate(5);
        return view('livewire.service.index', compact('services'));
    }
}
