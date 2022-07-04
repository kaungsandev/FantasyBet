<?php

namespace App\Http\Livewire;

use App\Models\Subscription;
use App\Models\Teams;
use App\Models\User;
use Livewire\Component;

class UserDashboard extends Component
{
    public $editFormVisible = false;

    public $subscription = null;

    public $user_id;

    public $name;

    public $email;

    public $coin;

    public $favouriteTeam = null;

    protected $listeners = [
        'UserUpdated' => 'render',
    ];

    public function render()
    {
        return view('livewire.user-dashboard', [
            'users' => User::all(),
            'teams' => Teams::all(),
        ]);
    }

    public function editFormToggle(User $user)
    {
        $this->editFormVisible = true;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->coin = $user->coin;
        $this->user_id = $user->id;
        $this->favouriteTeam = $user->fav_team;
    }

    public function updateUser()
    {
        // validate input
        $this->validate([
            'name' => 'required|min:4',
            'email' => 'required|email',
            'coin' => 'required|integer|min:0',
            'favouriteTeam' => 'required',
        ]);

        $user = User::findOrFail($this->user_id);
        $user->name = $this->name;
        $user->email = $this->email;
        $user->coin = $this->coin;
        $user->fav_team = $this->favouriteTeam;
        $user->save();

        $this->resetData();
        session()->flash('success', 'User updated');
    }

    public function unsubscribe($subscription_id)
    {
        Subscription::destroy($subscription_id);
        $this->emit('UserUpdated');
    }

    // reset current user data in compoenent
    public function resetData()
    {
        $this->editFormVisible = ! $this->editFormVisible;
        $this->name = null;
        $this->email = null;
        $this->coin = null;
        $this->user_id = null;
        $this->favouriteTeam = null;
        // Reset Error Messages
        $this->resetValidation();
    }
}
