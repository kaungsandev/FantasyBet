<?php

namespace App\Http\Livewire;

use App\Models\Fixture;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class FixtureForm extends Component
{
    public $matchday;
    public $homeTeam;
    public $awayTeam;
    public $time;

    protected $rules = [
        'event' => 'required',
        'home_team' => 'required|min:6',
        'away_team' => 'required|min:6',
        'kickoff_time' => 'required'
    ];

    public function render()
    {
        return view('livewire.fixture-form',[
            'fixtures' =>  Fixture::orderBy('matchday','DESC')->get()
        ]);
    }
    public function clearData(){
        $this->matchday =null;
        $this->homeTeam =null;
        $this->awayTeam =null;
        $this->time= null;
    }
    public function submit(){
       $this->validate();
        Fixture::create([
            'matchday' => $this->matchday,
            'homeTeam' => $this->homeTeam,
            'awayTeam' => $this->awayTeam,
            'time'  => $this->time,
            'result' =>"Vs",
            'status' => "SCHEDULED",
            'winner' => "Unknown"
        ]);
        $this->clearData();
        Cache::forget('matches');
        session()->flash('success', "Success");
    }
}
