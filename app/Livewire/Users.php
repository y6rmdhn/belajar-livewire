<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;

class Users extends Component
{
    use WithFileUploads;

    #[Validate('required|min:3')]
    public $name;

    #[Validate('required|email:dns|unique:users')]
    public $email;

    #[Validate('required|min:3')]
    public $password;

    #[Validate('image|max:5000')]
    public $avatar;

    public function createUser()
    {
        $validated = $this->validate();

        if ($this->avatar) {
            $validated['avatar'] = $this->avatar->store('avatar', 'public');
        }

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'avatar' => $validated['avatar'],
        ]);

        $this->reset();

        session()->flash('success', 'User Successfuly created.');

        $this->dispatch('user-created');
    }

    public function render()
    {
        return view('livewire.users', [
            'title' => 'Data Users',
            'users' => User::all(),
        ]);
    }
}
