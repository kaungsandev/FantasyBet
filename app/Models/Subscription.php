<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'packages_id', 'started_date', 'expire_date', 'expired'
    ];
    
    public function package(){
        return $this->belongsTo(Packages::class,'packages_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
