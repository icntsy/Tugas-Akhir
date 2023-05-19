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

    // protected $listeners = ['userDeleted'];
    public $sortType;
    public $sortColumn;

    // public function userDeleted(){
    //     $this->dispatchBrowserEvent('show-message', [
    //         'type' => 'success',
    //         'message' => "Data User Berhasil Di Hapus"
    //     ]);
    // }

    public function delete(User $user)
    {
        $user->delete();

        $this->dispatchBrowserEvent('show-message', [
            'type' => 'success',
            'message' => 'Data user berhasil dihapus.'
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
        $users = $users->paginate(5);
        return view('livewire.user.index', compact('users', 'users1'));
    }
}
