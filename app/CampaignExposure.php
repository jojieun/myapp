<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampaignExposure extends Model
{
    protected $table = 'campaign_exposure';
    protected $guarded = [];
    public function campaign(){
        return $this->belongsTo(Campaign::class);
    }
    public function exposure(){
        return $this->belongsTo(Exposure::class);
    }
}
