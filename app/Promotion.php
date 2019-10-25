<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    public function campaignpromotions(){
        return $this->hasMany(CampaignPromotion::class);
    }
}
