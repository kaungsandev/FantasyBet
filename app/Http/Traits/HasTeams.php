<?php 

namespace App\Http\Traits;
use App\Models\Teams;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

trait HasTeams {

    public function getTeamName($id){
        return Teams::where('id',$id)->first()->name;
    }
    public function getTeamShortName($id){
        return Teams::where('id',$id)->first()->short_name;
    }
}
