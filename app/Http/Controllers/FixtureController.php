<?php

namespace App\Http\Controllers;

use App\Http\Resources\FixtureCollection;
use App\Http\Resources\FixtureResource;
use App\Http\Traits\HasFixtures;
use App\Models\Fixture;
use Illuminate\Http\Request;

class FixtureController extends Controller
{
    use HasFixtures;

    // FOR API
    public function getFixtures(){
        return new FixtureCollection(
          $this->getLatestFixture()
        );
    }
    // refresh all fixture data for new season
    public function deleteAllFixtures(){
      Fixture::truncate();
    }
    // Sometimes, fixtures can be rescheduled and it would make the data inconsistency.
    public function deleteUnfinishedFixtures(){
      Fixture::where('finished',false)->delete();
    }
}
