<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exposure extends Model
{
    public function campaignexposures(){
        return $this->hasMany(CampaignExposure::class);
    }
}
