<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orderdetail extends Model
{
    protected $guarded = [];

    public function item($order)
    {
        return $this->where('order_id', $order)->count();
    }

}
