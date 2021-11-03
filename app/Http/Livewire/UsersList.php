<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Subscription;
use Livewire\Component;

class UsersList extends Component
{
    public $editFormVisible = false;
    public $subscription = null;
    public $user_id,$name,$email,$coin = null;

    protected $rules = [
        'name' => 'required|min:4',
        'email' => 'required|email',
        'coin' => 'required|integer|min:0',
    ];
    protected $listeners=[
        'UserUpdated' => 'render',
    ];

    public function render()
    {
        return view('livewire.users-list',[
            'users' => User::all()
        ]);
    }
    public function editFormToggle(User $user){
        $this->editFormVisible = true;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->coin = $user->coin;
        $this->user_id = $user->id;
    }
    public function updateUser(){
        // validate input
        $this->validate();
    
        $user = User::findOrFail($this->user_id);
        $user->name = $this->name;
        $user->email = $this->email;
        $user->coin = $this->coin;
        $user->save();

        $this->resetData();
        $this->emit('UserUpdated');
    }
    public function unsubscribe($subscription_id){
        Subscription::destroy($subscription_id);
        $this->emit('UserUpdated');
    }

    // reset current user data in compoenent
    public function resetData(){
        $this->editFormVisible = ! $this->editFormVisible;
        $this->name = null;
        $this->email = null;
        $this->coin = null;
        $this->user_id = null;
    }
    //send email to user
    public function sendMail($userId){
        
    }
}
