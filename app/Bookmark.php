<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $guarded = ['id'];
    
    public function campaignReviewer() //신청여부구하기
    {
        return $this->hasOne('App\CampaignReviewer', 'campaign_id', 'campaign_id');
    }
}
