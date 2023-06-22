<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Update extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $role;
    public $image;
    public $passwordVisible = false;
    public $passwordConfirmationVisible = false;

    protected $rules = [
        'name' => 'required',
        'email'=> 'required',
        'password' => 'nullable|confirmed',
        'role' => 'required',
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
            'password' => \Hash::make($this->password),
            'role' => $this->role,
        ];

        if (!empty($this->password)) {
            $userData['password'] = \Hash::make($this->password);
        }

        if ($this->image && $this->image->getClientOriginalName() !== $this->user->image) {
            // Hapus gambar yang sudah ada sebelumnya
            if ($this->user->image) {
                Storage::disk('public')->delete('images/' . $this->user->image);
            }

            $imageName = time() . '.' . $this->image->getClientOriginalExtension();
            $this->image->storeAs('public/images', $imageName);
            $userData['image'] = $imageName;
        }

        $this->user->update($userData);

        $this->dispatchBrowserEvent('show-message', [
            'type' => 'success',
            'message' => 'Data User Berhasil Diupdate'
            ]);

            $this->redirect('/user');
        }

        public function mount(User $user)
        {
            $this->user = $user;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->password = $user->password;
            $this->role = $user->role;
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
            return view('livewire.user.update');
        }
    }
