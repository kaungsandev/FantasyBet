<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    use HasFactory;
    
    protected $fillable =[
        'event',
        'finished', 
        'kickoff_time', 
        'started',
        'home_team', 
        'away_team', 
        'home_team_score',
        'away_team_score',
    ];

    public function bet()
    {
        return $this->hasMany('App\Bet','event','id');
    }
}
