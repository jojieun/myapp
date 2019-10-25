<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampaignPromotion extends Model
{
    protected $table = 'campaign_promotion';
    protected $guarded = [];
    public function campaign(){
        return $this->belongsTo(Campaign::class);
    }
    public function promotion(){
        return $this->belongsTo(Promotion::class);
    }
}
