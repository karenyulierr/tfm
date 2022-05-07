<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryTouristSite extends Model
{
    protected $table = 'categorie_tourist_sities';
    protected $fillable = [
        'category_id',
        'tourist_site_id',
        'user_id',
    ];
}
