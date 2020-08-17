<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    protected $table = 'reviews';
    protected $fillable = [
        'user_id','provider_id','booking_id','ride_id','review','rating',
    ];

    public function users()
    {
        return $this->hasOne('App\User','id','user_id');
    }

    public function provider()
    {
        return $this->hasOne('App\User','id','provider_id');
    }
}
