<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContinentCountryState extends Model
{
    protected $fillable = [
        'continent_country_id','title','code','is_expend'
    ];

    public function continent_country()
    {
        return $this->belongsTo('App\ContinentCountry');
    }
}
