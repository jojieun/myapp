<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
     protected $fillable = [

        'name', 'category_id', 'advertiser_id'

    ];
    public function advertiser(){
        return $this->belongsTo(Advertiser::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
