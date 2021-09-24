<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
    use HasFactory;

    protected $fillable =[
        'name', 'amount', 'duration', 'auto_sub' 
    ];
    public function users(){
        return $this->hasMany(User::class);
    }
    public function subscriptions(){
        return $this->hasMany(Subscription::class);
    }
}
