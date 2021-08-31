<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingSocialLink extends Model
{
    protected $fillable = [
        'name', 'link',
    ];
}
