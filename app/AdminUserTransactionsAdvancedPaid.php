<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminUserTransactionsAdvancedPaid extends Model
{
    protected $table = "adminUserTransactionsAdvancedPaids";

    protected $fillable = [
        'id','balance','updatedTime'
    ];

    protected $timestamp = false ;
}
