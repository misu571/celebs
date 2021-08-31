<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TalentCategory extends Model
{
    protected $fillable = [
        'user_id', 'category_id_list',
    ];
}
