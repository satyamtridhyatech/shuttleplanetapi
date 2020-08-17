<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Riderequests extends Model
{	
	use SoftDeletes;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

	protected $table = 'riderequests';
	
    protected $fillable = [ 
    'from','parent_request_id','request_by','to','journey_datetime','ride_type','vehicle','arrival_datetime','seats_required','wifi','charge_plug_socket','wheelchair_lift','skis','bicycles','ss','ms','ls','infant','child','booster','pets','wheelchair','wheelchair_foldable','airline','flight_number','comments','deleted_at','created_at','updated_at','from_city','to_city','meet_and_greet','non_emergency_medical'
		,'duration',
	];

	public function users()
	{
		return $this->belongsTo('App\User','request_by');
	}
}
