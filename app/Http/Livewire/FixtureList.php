<?php

namespace App\Http\Livewire;

use App\Http\Controllers\FixtureController;
use App\Models\Fixture;
use DateInterval;
use DateTimeImmutable;
use DateTimeZone;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class FixtureList extends Component
{
    public $matches;
    public function mount(FixtureController $fixtureController){
        if(cache('matches')){
            $this->matches = cache('matches');
        }else{
            //get current date
            $dateFrom = new DateTimeImmutable("now",new DateTimeZone('Asia/Yangon')); 
            //add 7 days to current date
            $dateTo = $dateFrom->add(DateInterval::createFromDateString('7 days'));
            //update Old Data First();
            $message = $fixtureController->updateFixtureFromApi();
            //call new One
            $fixtureController->getFixtureFromApi($dateFrom,$dateTo);
            $this->matches = Fixture::orderyBy('id','DESC')->all();
            $duration = now()->addHour();// cache will store data for 1hour 
            Cache::put('matches', $this->matches, $duration);
        }
    }
    public function render()
    {
        return view('livewire.fixture-list');
    }
}
