<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanTourist extends Model
{
    protected $table = 'plan_tourist';
    protected $fillable = [
        'name',
        'description',
        'value',
        'state',
        'user_id',
    ];
}
