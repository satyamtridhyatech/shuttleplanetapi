<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Provider extends Model
{
   protected $table = 'providers';
    protected $fillable = [
        'username','email','password','role','is_verified','verification_code','company_name','address','city','state','paypal_email','IBAN','SWIFT','rating','profile_image','user_id','agent_name','position',
    ];
    public function users()
    {
    	return $this->belongsTo('App\Users','user_id');
    }
}
