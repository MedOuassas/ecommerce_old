<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Maker extends Model
{
    protected $table = 'makers';
    protected $fillable = [
        'name_en',
        'name_ar',
        'contact_name',
        'email',
        'mobile',
        'facebook',
        'website',
        'address',
        'lat',
        'lng',
        'logo'
    ];
}
