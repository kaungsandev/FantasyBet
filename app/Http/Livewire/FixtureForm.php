<?php

namespace App\Http\Livewire;

use App\Models\Fixture;
use App\Models\Teams;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class FixtureForm extends Component
{
    public $event;
    public $home_team;
    public $away_team;
    public $kickoff_time;
    public $started = false;
    public $finished = false;
    public $fixture_type = 'football';
    public $home_team_score=0;
    public $away_team_score = 0;
    public $updateForm = false;

    protected $rules = [
        'event' => 'required',
        'home_team' => 'required',
        'away_team' => 'required',
        'kickoff_time' => 'required',
    ];

    public function render()
    {
        return view('livewire.fixture-form',[
            'fixtures' =>  Fixture::where('fixture_type','dota2')->get(),
            'teams' => Teams::all(),
        ]);
    }
    public function clearData(){
        $this->event =null;
        $this->home_team =null;
        $this->away_team =null;
        $this->kickoff_time= null;
        $this->fixture_type = 'football';
        $this->started = false;
        $this->finished = false;
        $this->home_team_score =0;
        $this->away_team_score = 0;
        $this->updateForm = false;
    }
    public function update($id){
        $fixture = Fixture::where('id',$id)->first();
        $this->event =$fixture->event;
        $this->home_team = $fixture->home_team;
        $this->away_team =$fixture->away_team;
        $this->kickoff_time= $fixture->kickoff_time;
        $this->fixture_type = $fixture->fixture_type;
        $this->started = $fixture->started;
        $this->finished = $fixture->finished;
        $this->home_team_score =$fixture->home_team_score;
        $this->away_team_score = $fixture->away_team_score;
        $this->updateForm = true;
    }
    public function submit(){
       $this->validate();
       $this->kickoff_time = new DateTime($this->kickoff_time,new DateTimeZone('Asia/Yangon'));
       $utc = new DateTimeZone('UTC'); 
       $this->kickoff_time->setTimezone($utc);

        $fixture = Fixture::updateOrCreate([
            'event' => $this->event,
            'home_team' => $this->home_team,
            'away_team' => $this->away_team,
        ],[
            'kickoff_time'  => $this->kickoff_time,
            'finished' => (bool)$this->finished,
            'started' =>(bool) $this->started,
            'home_team_score' => $this->home_team_score,
            'away_team_score' => $this->away_team_score,
        ]);
        $fixture->fixture_type = $this->fixture_type;
        $fixture->save();
        $this->clearData();
        session()->flash('success', "Success");
    }
}
