<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function carts() : HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function orders() : HasMany
    {
        return $this->hasMany(Order::class);
    }

}
