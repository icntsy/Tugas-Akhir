<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $role;
    public $image;

    protected $rules = [
        'name' => 'required',
        // 'email' => 'required|email|unique:users,email',
        'email'=> 'required',
        'password' => 'required|confirmed',
        'role' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg'
    ];

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function update()
    {
        $this->validate();

        $userData = [
            'name' => $this->name,
            'email' => $this->email,
            'password' => \Hash::make($this->password),
            'role' => $this->role,
        ];

        if (!empty($this->password)) {
            $userData['password'] = \Hash::make($this->password);
        }

        if ($this->image) {
            $imageName = time() . '.' . $this->image->getClientOriginalExtension();
            $this->image->storeAs('public/images', $imageName);
            $userData['image'] = $imageName;
        }

        $this->user->update($userData);

        $this->dispatchBrowserEvent('show-message', [
            'type' => 'success',
            'message' => 'Sukses mengupdate data user'
        ]);

        $this->redirect('/user');
    }

    // public function update()
    // {
    //     $this->validate();

    //     $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('Data User Berhasil Diupdate', ['name' => __('Article')])]);

    //     $this->user->update([
    //         'name' => $this->name,
    //         'email' => $this->email,
    //         'password' => \Hash::make($this->password),
    //         'role' => $this->role
    //     ]);
    //     return redirect("/user");
    // }

    public function mount(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = $user->password;
        $this->role = $user->role;
    }
    public function render()
    {
        return view('livewire.user.update');
    }
}
