<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $guarded = ['id'];
    
    public function reviewer(){
        return $this->hasOneThrough('App\Reviewer', 'App\CampaignReviewer','id','id','campaign_reviewer_id','reviewer_id');
    }
    public function campaign() 
    {
        return $this->hasOneThrough('App\Campaign', 'App\CampaignReviewer','id','id','campaign_reviewer_id','campaign_id');
    }
    public function campaign_reviewer(){
        return $this->belongsTo(CampaignReviewer::class);
    }
}
