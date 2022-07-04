<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class LeftPanel extends Component
{
    public $avatar;

    public $admin = false;

    public function mount()
    {
        // generate random avatar
        // $user_id = auth()->user()->id;
        // if(!cache('avatar-'.$user_id)){
        //     $random_avatar ='avataaars-'.rand(1,7).'.png';
        //     Cache::put('avatar-'.$user_id, $random_avatar);
        // }
    }

    public function render()
    {
        return view('livewire.left-panel');
    }
}
