<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Address extends Model
{
    protected $guarded = [];

    public function children() : HasMany
    {
        return $this->hasMany(Address::class, 'parent_id');
    }

    public function parent() : BelongsTo
    {
        return $this->belongsTo(Address::class, 'parent_id');
    }

    public function orders() : HasMany
    {
        return $this->hasMany(Order::class,);
    }
}
