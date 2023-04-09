<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected  $guarded = [];
    protected $with = ['product','orderDetail'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function orderDetail()
    {
        return $this->belongsTo(OrderDetail::class);
    }
}
