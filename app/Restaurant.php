<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
        'name', 'description', 'restaurant_category_id', 'latitude', 'longitude'
    ];

    public function category() {
        return $this->belongsTo(RestaurantCategory::class);
    }

}
