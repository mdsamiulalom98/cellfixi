<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorContact extends Model
{
    protected $guarded = [];
    public function course()
    {
        return $this->hasOne(Service::class, 'id', 'coursename');
    }
}
