<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;
    public function campaignpromotions(){
        return $this->hasMany(CampaignPromotion::class);
    }
}
