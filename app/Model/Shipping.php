<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $table = 'shippings';
    protected $fillable = [
        'name',
        'user_id',
        'lat',
        'lng',
        'logo'
    ];

    public function user(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
