<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TalentReviewList extends Model
{
    protected $fillable = [
        'user_id', 'follower_id', 'rate', 'review',
    ];
}
