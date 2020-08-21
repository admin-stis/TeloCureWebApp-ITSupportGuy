<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminUserTransactions extends Model
{
    protected $table = 'adminusertransactionstransaction';
    protected $fillable = [
        'id', 'aPIConnect', 'amount', 'bankTranId', 'baseFair', 'cardBrand', 'cardIssuer',
        'cardIssuerCountry', 'cardIssuerCountryCode', 'cardNo', 'cardType', 'currencyAmount',
        'currencyRate', 'currencyType', 'gwVersion', 'riskLevel', 'riskTitle', 'sessionkey',
        'status', 'storeAmount', 'tranDate', 'tranId', 'valid', 'validatedOn', 'valueA',
        'valueB', 'valueC', 'valueD'
    ] ;
    public $timestamp = false;
}
