<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UserForm extends Component
{
    public User $user;

    protected $rules = [
        'user.name' =>'required|string|min:6',
        'user.title' =>'required|string|min:6',
    ];

    public function save()
    {
        sleep(1);
        $this->validate();
        $this->user->save();
        $this->emit('userUpdated');
    }

    public function render()
    {
        return view('livewire.user-form');
    }
}
