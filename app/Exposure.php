<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exposure extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;
    public function campaignexposures(){
        return $this->hasMany(CampaignExposure::class);
    }
}
