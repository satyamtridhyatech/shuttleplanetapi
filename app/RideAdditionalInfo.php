<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RideAdditionalInfo extends Model
{
    protected $table = 'ride_additional_info';
    protected $fillable = [
        'ride_id','air_conditioning','reclined_seats','wifi','charge_plug_socket','	wheelchair_lift','female_driver','infant_seats','child_seats','	booster_seats','pets',
        'wheelchair','wheelchair_foldable',
    ];
}
