<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function OrderDetail()
    {
        return $this->hasMany(Orderdetail::class);
    }

    public function income($date)
    {
        return $this->where('created_at', 'LIKE', "$date%")->sum('total');
    }
}
