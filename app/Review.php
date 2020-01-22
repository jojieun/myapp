<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $guarded = ['id'];
    
    public function reviewer(){
        return $this->hasOne('App\Reviewer', 'id', 'reviewer_id');
    }
}
