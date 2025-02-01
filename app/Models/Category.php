<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    public function getRouteKeyName(): string
    {
        return 'slug';
    }


    public function products() : HasMany
    {
        return $this->hasMany(Product::class);
    }


}
