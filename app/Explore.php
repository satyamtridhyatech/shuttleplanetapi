<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Explore extends Model
{
    protected $fillable = [
        'continent_id','continent_country_id','continent_country_state_id',
        'title','type','image','widget','destination','destination_lat','destination_long','status', 'description'
    ];

    public function continent()
    {
        return $this->belongsTo('App\Continent');
    }

    public function continent_country()
    {
        return $this->belongsTo('App\ContinentCountry');
    }

    public function continent_country_state()
    {
        return $this->belongsTo('App\ContinentCountryState');
    }

}
