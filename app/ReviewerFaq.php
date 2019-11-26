<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReviewerFaq extends Model
{
    protected $guarded = ['id'];
    public function rFAQcategory() {
        return $this->belongsTo(ReviewerFaqCate::class, 'reviewer_faq_cate_id');
    }
}
