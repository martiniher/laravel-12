<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
    protected $fillable = [
        'description',
    ];

    //
    public function events(){
        return $this->hasOne('App\Models\Address');
    }
}
