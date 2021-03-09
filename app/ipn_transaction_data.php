<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ipn_transaction_data extends Model
{
    protected $table = "ipn_transaction_data";

    protected $fillable = [
        'status',
        'tran_date',
        'tran_id',
        'amount', 
        'val_id', 
        'store_amount', 
        'currency',
        'bank_tran_id', 
        'card_type',
        
        'emi_instalment',
        'emi_amount',
        'emi_description',
        'emi_issuer',
        
        'card_no',
        'card_issuer',
        'card_brand',
        'card_issuer_country',
        'card_issuer_country_code',
        
        'APIConnect',
        'validated_on',
        'gw_version'
    ];

    public $timestamps = false;
}
