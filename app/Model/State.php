<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';
    protected $fillable = [
        'state_name_en',
        'state_name_ar',
        'country_id',
        'city_id'
    ];

    public function country()
    {
        return $this->hasOne('App\Model\Country', 'id', 'country_id');
    }

    public function city()
    {
        return $this->hasOne('App\Model\City', 'id', 'city_id');
    }
}
