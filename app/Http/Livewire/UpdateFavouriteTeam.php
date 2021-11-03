<?php

namespace App\Http\Livewire;

use App\Models\Teams;
use App\Models\User;
use Livewire\Component;

class UpdateFavouriteTeam extends Component
{
    public $selectedTeam;
    protected $rules =[
        'selectedTeam' => 'required'
    ];
    public function render()
    {
        return view('livewire.update-favourite-team',[
            'teams' => Teams::where('id','<=',20)->get(),
        ]);
    }
    public function updateFavTeam(){
        $this->validate();
        $user = User::where('id',auth()->user()->id)->first();
        $user->fav_team = $this->selectedTeam;
        $user->update();
        return redirect()->to('/');
    }
}
