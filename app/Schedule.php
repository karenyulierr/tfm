<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedule';
    protected $fillable = [
        'description',
        'start_time',
        'end_time',
        'state',
        'tourist_sities_id',
        'user_id',
    ];
}
