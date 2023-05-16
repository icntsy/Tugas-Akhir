<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Update extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function update()
    {
        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('Data Profile Berhasil Diupdate', ['name' => __('Article')])]);
        $validatedData = $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user = Auth::user();
        $user->name = $this->name;
        $user->email = $this->email;

        if (!empty($this->password)) {
            $user->password = bcrypt($this->password);
        }

        $user->save();

        // session()->flash('message', 'Data profile berhasil diperbarui.');

        return redirect("/profile");
        // return redirect()->back();
    }

    public function render()
    {
        return view('livewire.profile.update');
    }
}
