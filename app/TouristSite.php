<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TouristSite extends Model
{
    protected $table = 'tourist_sites';
    protected $fillable = [
        'name',
        'description',
        'nit',
        'email',
        'phone',
        'main_image',
        'address',
        'latitude',
        'longitude',
        'state',
        'user_id'
    ];
}
