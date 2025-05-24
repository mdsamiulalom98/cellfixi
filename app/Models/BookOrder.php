<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookOrder extends Model
{
    use HasFactory;

    public function bookdetails()
    {
        return $this->hasOne(Portfolio::class, 'id' , 'book_id');
    }
    public function status()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status');
    }
}
