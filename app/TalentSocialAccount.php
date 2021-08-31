<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TalentSocialAccount extends Model
{
    protected $fillable = [
        'user_id',
        'social_acc_name',
        'social_acc_id',
        'followers',
    ];
}
