<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';
    protected $fillable = [
        'country_name_en',
        'country_name_ar',
        'code',
        'mob',
        'logo'
    ];
}
