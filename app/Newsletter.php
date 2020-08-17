<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    protected $table = 'newsletter_subscription';
    protected $fillable = [
        'email',
    ];
}
