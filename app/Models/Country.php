<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $guarded = [];


    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }



}
