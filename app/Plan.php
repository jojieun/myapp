<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $guarded = ['id'];
    
    public function reviewer(){
        return $this->belongsTo(Reviewer::class);
    }
    public function areaplans(){
        return $this->hasMay('App\AreaPlan');
    }
    public function categoryplans(){
        return $this->hasMay('App\CategoryPlan');
    }

}
