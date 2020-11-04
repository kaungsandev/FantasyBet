<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    use HasFactory;
    
    protected $fillable =[
        'matchday',
        'homeTeam', 
        'awayTeam', 
        'time',
        'result', 
        'status', 
        'winner'
    ];

    public function bet()
    {
        return $this->hasMany('App\Bet','match_id','id');
    }
}
