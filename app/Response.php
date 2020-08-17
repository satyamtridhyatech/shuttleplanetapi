<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $table = 'responses';
    protected $fillable = [
        'msg_id','responder_id','respondent_id','response',
    ];

    public function messages()
    {
        return $this->hasOne('App\Messages','msg_id');
    }
    public function users()
    {
        return $this->hasOne('App\User','id','respondent_id');
    }
}
