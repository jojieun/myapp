<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = ['id'];
    public function reviewer(){
        return $this->belongsTo(Reviewer::class);
    }
    public function advertiser(){
        return $this->belongsTo(Advertiser::class);
    }
    public function community(){
        return $this->belongsTo(Community::class);
    }
}
