<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
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
        'name' => 'required|max:255',
        'email' => 'required|email:dns|unique:users,email',
        'password' => 'required|confirmed',
        'role' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg'
    ];

    public function create(){
        $this->validate();

        $imageName = null;
        if ($this->image) {
            $imageName = time() . '.' . $this->image->getClientOriginalExtension();
            $this->image->storeAs('public/images', $imageName);
        }

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => \Hash::make($this->password),
            'role' => $this->role,
            'image' => $imageName
            ]);

            $this->dispatchBrowserEvent('show-message', [
                'type' => 'success',
                'message' => 'Sukses Menambah Data User'
                ]);
                $this->redirectRoute('user.index');
            }

            public function togglePasswordVisibility()
            {
                $this->passwordVisible = !$this->passwordVisible;
            }

            public function togglePasswordConfirmationVisibility()
            {
                $this->passwordConfirmationVisible = !$this->passwordConfirmationVisible;
            }
            /**
            * Get the view / contents that represent the component.
            *
            * @return \Illuminate\View\View|string
            */
            public function render()
            {
                return view('livewire.user.create');
            }
        }
