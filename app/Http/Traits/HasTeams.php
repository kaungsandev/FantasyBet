<?php

namespace App\Http\Traits;

use App\Models\Teams;

trait HasTeams
{
    public function getTeamName($id)
    {
        return Teams::where('id', $id)->first()->name;
    }

    public function getTeamShortName($id)
    {
        return Teams::where('id', $id)->first()->short_name;
    }
}
