<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
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

    protected $table = 'offers';

    protected $fillable = [
        'offered_by','request_id','from','to','departure_datetime','arrival_datetime','total_seats','vehicle','status','price','batch_id','is_deleted','currency_code','vehicle_model'
    ];

    public function ride_requests()
    {
        return $this->belongsTo('App\Riderequests','request_id');
    }

    public function agent()
    {
        return $this->belongsTo('App\User','offered_by','id');
    }
    
}
