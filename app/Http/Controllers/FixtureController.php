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
}
