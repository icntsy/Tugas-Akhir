<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $image;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function update()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|min:8|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        $user = Auth::user();
        $user->name = $this->name;
        $user->email = $this->email;

        if (!empty($this->password)) {
            $user->password = bcrypt($this->password);
        }

        if ($this->image) {
            $imageName = time() . '.' . $this->image->getClientOriginalExtension();
            $this->image->storeAs('public/images', $imageName);
            $user->image = $imageName;
        }

        $user->save();

        $this->dispatchBrowserEvent('show-message', [
            'type' => 'success',
            'message' => __('Data Profile Berhasil Diupdate', ['name' => __('Article')]),
        ]);

        return redirect("/profile");
    }

    public function render()
    {
        return view('livewire.profile.update');
    }
}
