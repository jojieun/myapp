<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    
    protected $guarded = ['id'];
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
    
    public function brandCategory() //카테고리 구하기
    {
        return $this->hasOneThrough('App\Category', 'App\Brand', 'id', 'id', 'brand_id', 'category_id');
    }
    public function campaignReviewers() //신청인원 구하기
    {
        return $this->hasMany(CampaignReviewer::class);
    }
}
