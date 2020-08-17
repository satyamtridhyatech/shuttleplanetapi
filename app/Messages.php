<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    protected $table = 'messages';
    protected $fillable = [

        'sender_id','receiver_id','booking_id','provider_id','subject','message','is_read',
    ];
    public function users()
    {
        return $this->hasOne('App\User','id','sender_id');
    }
    public function responses()
    {
        return $this->hasMany('App\Response','id','msg_id');
    }
    public function providers()
    {
        return $this->hasOne('App\Provider','user_id','provider_id');
    }
    public function customers()
    {
        return $this->hasOne('App\Customers','user_id','sender_id');
    }

}
