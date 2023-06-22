<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Update extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $passwordVisible = false;
    public $passwordConfirmationVisible = false;
    public $image;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'nullable|confirmed',
        'image' => 'nullable|image|mimes:jpeg,png,jpg'
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
            'password' => Hash::make($this->password),
        ];

        $user = Auth::user();
        $user->name = $this->name;
        $user->email = $this->email;

        if (!empty($this->password)) {
            $userData['password'] = Hash::make($this->password);
        }

        if ($this->image && $this->image->getClientOriginalName() !== $user->image) {
            // Hapus gambar yang sudah ada sebelumnya
            if ($user->image) {
                Storage::disk('public')->delete('images/' . $user->image);
            }

            $imageName = time() . '.' . $this->image->getClientOriginalExtension();
            $this->image->storeAs('public/images', $imageName);
            $userData['image'] = $imageName;
        }

        $user->update($userData);

        $this->dispatchBrowserEvent('show-message', [
            'type' => 'success',
            'message' => 'Data User Berhasil Diupdate'
            ]);

            return redirect('/profile');
        }

        public function mount()
        {
            $user = Auth::user();
            $this->name = $user->name;
            $this->email = $user->email;
            $this->password = $user->password;
        }

        public function togglePasswordVisibility()
        {
            $this->passwordVisible = !$this->passwordVisible;
        }

        public function togglePasswordConfirmationVisibility()
        {
            $this->passwordConfirmationVisible = !$this->passwordConfirmationVisible;
        }

        public function render()
        {
            return view('livewire.profile.update');
        }
    }
