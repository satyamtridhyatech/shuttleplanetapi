<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
   protected $table = 'users';
    protected $fillable = [
        'username','email','password','role','is_verified','verification_code','provider','provider_id',
    ];

    public function customers()
    {
        return $this->hasOne('App\Customers','user_id');
    }

    public function providers()
    {
        return $this->hasOne('App\Provider','user_id');
    }

    public function requests()
    {
        return $this->belongsTo('App\Riderequests','request_by');
    }
}
