<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanImage extends Model
{
    protected $table = 'plan_images';
    protected $fillable = [
        'name',
        'state',
        'tourist_sities_id',
        'user_id',
    ];
}
