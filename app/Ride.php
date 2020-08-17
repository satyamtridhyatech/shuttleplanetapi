<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    protected $table = 'rides';
    protected $fillable = [
        'provider_id','seats_available','from','from_door','to_door','to','journey_date','return_date','ride_type','days_available','vehicle_type','price','currency_symbol','is_electric_vehicle','batch_id',
    ];

    public function additional_info()
    {
        return $this->hasOne('App\RideAdditionalInfo','ride_id');
    }
    public function users()
    {
    	return $this->belongsTo('App\User','provider_id');
    }

    public function providers()
    {
        return $this->hasOne('App\Provider','user_id','provider_id');
    }

}

