<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocationMap extends Model
{
    protected $fillable = [
        'from_city', 'from_lat', 'from_long', 'from_content', 'to_city',
        'to_lat', 'to_long', 'to_content'
    ];

    public function setFromCityAttribute($value)
    {
        $this->attributes['from_city'] = strtolower($value);
    }

    public function setToCityAttribute($value)
    {
        $this->attributes['to_city'] = strtolower($value);
    }

}
