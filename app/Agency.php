<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $guarded = ['id'];
    public function advertiser(){
        return $this->belongsTo(Advertiser::class);
    }
}
