<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'transaction_id';
    
    protected $fillable = [
        'transaction_id', 'user_id', 'tx_id', 'bank_tx_id', 'amount', 'currency', 'payment_option', 'status', 'created_at', 'updated_at',
    ];
}
