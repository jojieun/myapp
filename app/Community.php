<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Community extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'title',
        'content',
        'notification',
        'view_count',
        'notification',
    ];
    
    protected $hidden = [
        'reviewer_id',
        'advertiser_id',
        'notification',
        'deleted_at',
    ];

    protected $dates = [
        'deleted_at'
    ];
    
    public function reviewer() {
        return $this->belongsTo(Reviewer::class);
    }
    public function advertiser() {
        return $this->belongsTo(Advertiser::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class)->latest();
    }
}
