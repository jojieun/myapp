<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $guarded = ['id'];
    
    public function campaign() {
        return $this->hasOne('App\Campaign','id','campaign_id');
    }
}
