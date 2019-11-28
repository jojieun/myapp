<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaPlan extends Model
{
    protected $table = 'area_plan';
    protected $guarded = ['id'];
    public function plan(){
        return $this->belongsTo(Plan::class);
    }
}
