<?php

namespace App\Http\Livewire;

use App\Console\UpdateTeamsTask;
use App\Models\Teams;
use Livewire\Component;

class ManageTeam extends Component
{
    public $name;

    public $short_name;

    protected $rules = [
        'name' => 'required',
        'short_name' => 'required',
    ];

    public function render()
    {
        return view('livewire.manage-team', [
            'teams' => Teams::orderBy('id', 'desc')->get(),
        ]);
    }

    public function clearData()
    {
        $this->name = null;
        $this->short_name = null;
    }

    public function submit()
    {
        $this->validate();
        Teams::create([
            'code' => rand(1000, 2000),
            'name' => $this->name,
            'short_name' => $this->short_name,
        ]);
        $this->clearData();
        session()->flash('success', 'New Team Added');
    }

    public function updateTeams(UpdateTeamsTask $updateTeamsTask)
    {
        $updateTeamsTask->__invoke();
    }
}
