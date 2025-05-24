<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function bookorders(){
        return $this->hasMany(BookOrder::class, 'order_status')->select('id','order_status');
    }
}
