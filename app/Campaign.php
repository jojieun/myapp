<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    
    protected $guarded = [];
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
    public function campaignexposure(){
        return $this->belongsTo(CampaignExposure::class);
    }
    public function campaignpromotion(){
        return $this->belongsTo(CampaignPromotion::class);
    }
    public function brandCategory()
    {
//        return $this->hasMay(Category::class)->using(Brand::class);
    }   
}

