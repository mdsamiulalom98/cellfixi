<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = [];
    public function pricings()
    {
        return $this->hasMany(Pricing::class, 'service_id', 'id');
    }
    public function mentors()
    {
        return $this->hasOne(BlogCategory::class, 'id', 'category_id');
    }
}
