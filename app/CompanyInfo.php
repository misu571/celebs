<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    protected $fillable = [
        'about', 'tnc', 'ppy', 'faq',
    ];
}
