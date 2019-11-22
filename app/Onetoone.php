<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Onetoone extends Model
{
    protected $guarded = ['id'];
    
    public function qcategory() {
        return $this->belongsTo(Qcategory::class);
    }
    public function reviewer() {
        return $this->belongsTo(Reviewer::class);
    }
    public function advertiser() {
        return $this->belongsTo(Advertiser::class);
    }
}
