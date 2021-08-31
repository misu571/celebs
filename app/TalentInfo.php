<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TalentInfo extends Model
{
    protected $fillable = [
        'user_id',
        'about_me',
        'rating',
        'intro_video',
        'vid_price',
        'chat_price',
        'cut_ratio',
        'total_income',
        'total_withdrawal',
        'currency',
        'response_time',
        'category_id',
        'feature',
        'bank_name',
        'branch_name',
        'acc_name',
        'acc_id',
        'swift_code',
        'available',
        'follower_id_list',
        'notify_id_list',
    ];
}
