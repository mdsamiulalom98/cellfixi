<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventRegister extends Model
{
    protected $guarded = [];

    public function event_des(){
        return $this->hasOne(HowItWork::class, 'id', 'event_id');
    }


}
