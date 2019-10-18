<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    public function advertiser(){
        return $this->belongsTo(Advertiser::class);
    }
    public function channel(){
        return $this->belongsTo(Channel::class);
    }
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function area(){
        return $this->belongsTo(Area::class);
    }
}
