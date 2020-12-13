<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bet extends Model
{
    use HasFactory;

    protected $fillable = [
        'match_id',
        'fixture', 
        'winner', 
        'supporter', 
        'amount'  
    ];

    public function hasFixture(){
        return $this->belongsTo('App\Fixture','id',);
    }

}
