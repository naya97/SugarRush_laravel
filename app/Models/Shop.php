<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class Shop extends Model
{
    use Searchable;
    
    protected $guarded = [];

    //who has my PK
    public function products() : HasMany {
        return $this->hasMany(Product::class);
    }

    public function toSearchableArray(){   
        return [
            'name' => $this->name,
        ];
    }


}
