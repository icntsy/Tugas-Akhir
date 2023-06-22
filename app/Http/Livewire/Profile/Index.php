<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $queryString = ['search'];

    protected $listeners = ['userDeleted'];
    public $sortType;
    public $sortColumn;


    public function mount()
    {
        $this->user = Auth::user();
    }

    public function userDeleted(){
        $this->dispatchBrowserEvent('show-message', [
            'type' => 'success',
            'message' => "Data User Berhasil Di Hapus"
            ]);
        }
        /**
        * Get the view / contents that represent the component.
        *
        * @return \Illuminate\View\View|string
        */


        public function render()
        {
            $users = User::query();
            $users1 = User::query();
            $users->where('name', 'like', '%'.$this->search.'%')
            ->orWhere('email', 'like', '%'.$this->search.'%')
            ->orWhere('role', 'like', '%'.$this->search.'%');
            $users = $users->paginate(10);
            return view('livewire.profile.index', compact('users', 'users1'));
        }
    }
