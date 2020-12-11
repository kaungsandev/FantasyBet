<?php

namespace App\Http\Livewire;

use App\Models\Fixture;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class FixtureList extends Component
{
    public $matches;
    public function mount(){
        if(cache('date') ===  date("Y-m-d")){
            $this->updateFixture->getFixtureFromApi(); //update fixture data
         }
         if(cache('matches')){
             $this->matches = cache('matches');
         }else{
            $this->matches = Fixture::where('status','SCHEDULED')
            ->orderBy('id','DESC')->take(10)->get();
            $duration = now()->addDays(7);
            Cache::put('matches', $this->matches, $duration);
         }
    }
    public function render()
    {
        return view('livewire.fixture-list');
    }
}
