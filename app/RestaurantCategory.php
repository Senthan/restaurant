<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestaurantCategory extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    public function restaurants() {
        return $this->hasMany(Restaurant::class);
    }
}
