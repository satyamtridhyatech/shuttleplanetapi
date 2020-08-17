<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Continent extends Model
{
    protected $fillable = [
        'title','code','latitude','longitude','google_place_id'
    ];
}
