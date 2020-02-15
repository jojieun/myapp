<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $guarded = ['id'];
    
    public function reviewer() {
        return $this->belongsTo('App\Reviewer');
    }
    public function bank() {
        return $this->belongsTo('App\Bank');
    }
}
