<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $guarded = [];

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function address() : BelongsTo {
        return $this->belongsTo(Address::class);
    }

    public function productDetails() : HasMany {
        return $this->hasMany(ProductDetails::class);
    }
}
