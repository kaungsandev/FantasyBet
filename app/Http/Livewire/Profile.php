<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Profile extends Component
{
    public $username = '';
    public $email = '';

    public function mount(){
        $this->username = auth()->user()->name;
        $this->email = auth()->user()->email;
    }
    public function render()
    {
        return view('livewire.profile');
    }
}
