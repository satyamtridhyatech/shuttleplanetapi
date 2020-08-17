<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContinentCountry extends Model
{
    protected $fillable = [
        'continent_id','title','code','is_expend'
    ];

    public function continent()
    {
        return $this->belongsTo('App\Continent');
    }
}
