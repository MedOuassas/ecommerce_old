<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';
    protected $fillable = [
        'city_name_en',
        'city_name_ar',
        'country_id'
    ];

    public function country()
    {
        return $this->hasOne('App\Model\Country', 'id', 'country_id');
    }
}
