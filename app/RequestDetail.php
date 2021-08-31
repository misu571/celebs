<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestDetail extends Model
{
    protected $fillable = [
        'submit_by',
        'talent_id',
        'to',
        'from',
        'pronoun',
        'occasion',
        'instruction',
        'hide',
        'payment_id',
        'video',
        'status',
        'rate',
        'comment',
        'created_at',
        'updated_at',
    ];
}
