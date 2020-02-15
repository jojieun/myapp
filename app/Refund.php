<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    protected $guarded = ['id'];
    public function advertiser(){
        return $this->belongsTo(Advertiser::class);
    }
    public function campaign(){
        return $this->belongsTo(Campaign::class);
    }
}
