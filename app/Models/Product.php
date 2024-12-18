<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use Searchable;

    protected $guarded=[];

    public function shop() : BelongsTo{
        return $this->belongsTo(Shop::class);
    }

    public function toSearchableArray(){   
        return [
            'name' => $this->name,
        ];
    }

    public function favourites() : HasMany {
        return $this->hasMany(Favorite::class);
    }

    public function productDetails() : HasMany {
        return $this->hasMany(ProductDetails::class);
    }
}
