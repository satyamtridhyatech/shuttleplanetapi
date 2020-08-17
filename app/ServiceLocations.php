<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceLocations extends Model
{
    protected $table = 'provider_service_areas';

    protected $fillable = [
      'provider_id','location',
    ];

	public function provider()
    {
        return $this->belongsTo('App\Provider','provider_id','user_id');
    }
}
