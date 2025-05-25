<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $guarded = [];

    public function blogcategory()
    {
        return $this->hasOne(BlogCategory::class, 'id', 'category_id');
    }

    
}
