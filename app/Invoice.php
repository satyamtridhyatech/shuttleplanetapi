<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = "invoices";

    protected $fillable = [
        'booking_id','booked_by','provider_id','payment_id','amount','payment_type'
    ];

    public function users()
    {
        return $this->HasOne('App\User','id','booked_by');
    }
    public function provider()
    {
        return $this->hasOne('App\User','id','provider_id');
    }

    public function booking()
    {
        return $this->hasOne('App\Booking','id','booking_id');
    }
}
