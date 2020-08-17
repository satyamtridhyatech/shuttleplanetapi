<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $table="testimonials";
    protected $fillable = [
        'review_by','subject','testimonial','admin_approved','deny',
    ];

    public function users()
    {
        return $this->hasOne('App\User','id','review_by');
    }
    public function customers()
    {
        return $this->hasOne('App\Customers','user_id','review_by');
    }
}
