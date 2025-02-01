<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Checkout extends Model
{

    public function getRouteKeyName(): string
    {
        return 'external_id';
    }

    public function orders() : HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
