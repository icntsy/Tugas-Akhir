<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $queryString = ['search'];

    public $sortType;
    public $sortColumn;

    public function delete(User $user)
    {
        $user->delete();

        $this->dispatchBrowserEvent('show-message', [
            'type' => 'error',
            'message' => 'Data User Berhasil Di Hapus.'
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

            $no = ($users->currentPage() - 1) * $users->perPage() + 1;
            return view('livewire.user.index', compact('users', 'users1', 'no'));
        }
    }
