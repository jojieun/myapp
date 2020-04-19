<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampaignReviewer extends Model
{
    protected $guarded = ['id'];
    public function campaign(){
        return $this->belongsTo(Campaign::class);
    }
    public function reviewer(){
        return $this->belongsTo(Reviewer::class);
    }
    public function plan()
    {
        return $this->hasOne('App\Plan', 'reviewer_id', 'reviewer_id');
    }
    public function review()//없애도 되는지 확인하고 new_review와 교체
    {
        return $this->hasOne('App\Review', 'campaign_id', 'campaign_id');
    }
    public function new_review()
    {
        return $this->hasOne('App\Review', 'reviewer_id', 'reviewer_id');
    }
    public function channel_reviewer()
    {
        return $this->hasMany('App\ChannelReviewer', 'reviewer_id', 'reviewer_id');
    }
}
