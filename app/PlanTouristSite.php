<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanTouristSite extends Model
{
    protected $table = 'plan_tourist_sities';
    protected $fillable = [
        'plan_tourist_id',
        'tourist_sities_id',
        'user_id',
    ];
}
