<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TalentAccount extends Model
{
    protected $fillable = [
        'user_id', 'order_id', 'request_id', 'ratio', 'income', 'currency', 'status',
    ];
}
