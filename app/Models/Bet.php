<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bet extends Model
{
    use HasFactory;

    protected $fillable = [
        'match_id',
        'winner', 
        'supporter', 
        'amount'  ,
        'current_point',
        'paid'
    ];

    
    public function fixture(){
        return $this->belongsTo(Fixture::class,'match_id');
    }
    public function team(){
        return $this->belongsTo(Teams::class,'winner');
    }
    public function user(){
        return $this->belongsTo(User::class,'supporter');
    }

}
