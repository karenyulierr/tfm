<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';
    protected $fillable = [
        'name_person',
        'email',
        'stars',
        'description',
        'tourist_sities_id'
    ];
}
