<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customers extends Model
{
    protected $table = 'customers';
    protected $fillable = [
        'user_id','email','first_name','last_name','address','city','state','profile_image','phone_number','date_of_birth','zipcode','company',
    ];

    public function users()
    {
        return $this->belongsTo('App\Users','user_id');
    }


}
