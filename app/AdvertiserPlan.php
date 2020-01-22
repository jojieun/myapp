<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvertiserPlan extends Model
{
    protected $guarded = ['id'];
    public function advertiser(){
        return $this->belongsTo(Advertiser::class);
    }
    
    public function campaigns(){
        return $this->hasMany('App\Campaign', 'advertiser_id', 'advertiser_id');
    }
}
