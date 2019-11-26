<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvertiserFaq extends Model
{
    protected $guarded = ['id'];
    public function aFAQcategory() {
        return $this->belongsTo(AdvertiserFaqCate::class, 'advertiser_faq_cate_id');
    }
}
