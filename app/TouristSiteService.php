<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TouristSiteService extends Model
{
    protected $table = 'tourist_site_services';
    protected $fillable = [
        'tourist_site_id',
        'service_id',
        'start_day',
        'end_day',
        'value',
        'state',
        'user_id'
    ];
}
