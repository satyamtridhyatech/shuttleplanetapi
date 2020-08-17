<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';
    protected $fillable = [
        'ride_id','vehicle_type','no_of_passengers','from','to','journey_date','return_date','provider','price','payment_type'
        , 'coupon', 'discount_amount', 'type','batch_id'
    ];

    public function users()
    {
        return $this->HasOne('App\User','id','booked_by');
    }

    public function rides()
    {
        return $this->hasOne('App\Ride','id','ride_id');
    }

    public function additional_info()
    {
        return $this->hasOne('App\RideAdditionalInfo','ride_id','ride_id');
    }
    public function providers()
    {
        return $this->hasOne('App\Provider','user_id','provider_id');
    }

    public function provider()
    {
        return $this->hasOne('App\User','id','provider_id');
    }
}
