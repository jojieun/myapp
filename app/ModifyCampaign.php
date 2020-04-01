<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModifyCampaign extends Model
{
    protected $guarded = ['id'];
    public function campaign(){
        return $this->belongsTo(Campaign::class);
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
