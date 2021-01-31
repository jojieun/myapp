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
    public function review()
    {
        return $this->hasOne('App\Review');
    }

    public function channel_reviewer()
    {
        return $this->hasMany('App\ChannelReviewer', 'reviewer_id', 'reviewer_id');
    }
    public function penalty()
    {
        return $this->hasOne('App\Penalty', 'reviewer_id', 'reviewer_id')->orderBy('fixed_date', 'desc');
    }
    public function messages(){
        return $this->hasMany('App\Message', 'campaign_id', 'campaign_id');
    }
    
}
