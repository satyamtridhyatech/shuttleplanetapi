<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IP_Location extends Model
{
     protected $table = 'ip_geo_locations';
    protected $fillable = [
        'ip','country','city','continent','latitude','longitude','time_zone','postal_code','subdivision'
    ];

}
