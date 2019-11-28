<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChannelReviewer extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;
    public function channel(){
        return $this->belongsTo(Channel::class);
    }
    public function reviewer(){
        return $this->belongsTo(Reviewer::class);
    }
}
