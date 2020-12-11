<?php

namespace App\Http\Livewire;

use App\Http\Controllers\FixtureController;
use App\Models\Fixture;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class FixtureList extends Component
{
    public $matches;
    public function mount(FixtureController $fixureController){
        
        if(cache('date') ===  date("Y-m-d")){
            $fixureController->getFixtureFromApi();
        }
        if(cache('matches')){
            $this->matches = cache('matches');
            dd($this->matches);
        }else{
            $this->matches = Fixture::where('status','SCHEDULED')
            ->orderBy('id','ASC')->take(10)->get();
            $duration = now()->addDays(7);
            Cache::put('matches', $this->matches, $duration);
        }
    }
    public function render()
    {
        return view('livewire.fixture-list');
    }
}
