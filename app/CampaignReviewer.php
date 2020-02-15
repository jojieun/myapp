<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampaignReviewer extends Model
{
    protected $guarded = ['id'];
    
    public function reviewer(){
        return $this->belongsTo(Reviewer::class);
    }
    public function plan()
    {
        return $this->hasOne('App\Plan', 'reviewer_id', 'reviewer_id');
    }
    public function review()
    {
        return $this->hasOne('App\Review', 'campaign_id', 'campaign_id');
    }
}
