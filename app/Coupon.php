<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'coupon_code', 'valid_from', 'valid_upto', 'ride_type', 'discount_type', 'usage', 'discount'
    ];

    public function setRideTypeAttribute($value)
    {
        $this->attributes['ride_type'] = implode(',', $value);
    }
}
