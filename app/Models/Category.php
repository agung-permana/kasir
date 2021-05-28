<?php

namespace App\Models;

use App\Models\product;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function product()
    {
        return $this->hasMany(product::class);
    }
}
