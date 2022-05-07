<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    protected $table = 'rules';
    protected $fillable = [
        'description',
        'state',
        'tourist_sities_id',
        'user_id',
    ];
}
