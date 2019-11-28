<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $guarded = ['id'];
    public function areas(){
        return $this->hasManyThrough('App\Area', 'App\AreaPlan', 'plan_id', 'id', 'id', 'area_id');
    }
    public function regions(){
        return $this->hasManyThrough('App\Region', 'App\AreaPlan', 'area_id', 'id', 'id', 'area_id');
    }
    public function categories(){
        return $this->hasManyThrough('App\Category', 'App\CategoryPlan', 'plan_id', 'id', 'id', 'category_id');
    }
    public function channels(){
        return $this->hasManyThrough('App\Channel', 'App\ChannelReviewer', 'reviewer_id', 'id', 'reviewer_id', 'channel_id');
    }
    public function reviewer(){
        return $this->belongsTo(Reviewer::class);
    }
    public function areaplans(){
        return $this->hasMany(AreaPlan::class);
    }
    public function categoryplans(){
        return $this->hasMany('App\CategoryPlan');
    }
    
}
