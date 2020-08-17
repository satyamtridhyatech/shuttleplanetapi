<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentInfo extends Model
{
    protected $table = 'payment_info';

    protected $fillable = [

        'txn_id','mc_gross','protection_eligibility','payer_id','payment_date','payment_status','first_name','mc_fee','payer_status','business',
        'payer_email','payment_type','last_name','receiver_id','pending_reason','txn_type','mc_currency','auth'
    ];

    public $timestamps = false;
}
