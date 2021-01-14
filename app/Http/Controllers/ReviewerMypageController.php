<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Image;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;
use App\Reviewer;
use App\Review;
use App\Deposit;

class ReviewerMypageController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth.reviewer', ['except' => ['index', 'show']]);
    }
    //    마이페이지
    public function home(){
        
        $nowUser = auth()->user()->id;
        //리뷰전략 작성 여부
        $nowUser = Reviewer::whereId($nowUser)->withCount('plan')->with('channelreviewers')->first();
        $nowdate = Carbon::now();
//        신청**캠페인
        $applyCampaigns = \App\CampaignReviewer::where('reviewer_id',$nowUser->id)
            ->join('campaigns', function($join) {
                $join->on('campaign_reviewers.campaign_id','=','campaigns.id')
                    ->whereDate('end_recruit','>=',Carbon::now()->toDateString());
            })
            ->leftjoin('areas','campaigns.area_id','=','areas.id')
            ->leftjoin('regions','areas.region_id','=','regions.id')
            ->leftjoin('channels','channels.id','=','campaigns.channel_id')
            ->leftjoin('brands','campaigns.brand_id','=','brands.id')
            ->leftjoin('categories','categories.id','=','brands.category_id')
            ->select('campaigns.id as campaign_id',
            'campaigns.name',
             'campaigns.form',
            'campaigns.main_image',
            'campaigns.recruit_number',
            'campaigns.offer_point',
            'campaigns.offer_goods',
            'campaigns.end_recruit',
            'areas.name as area_name',
            'regions.name as region_name',
            'channels.name as channel_name',
            'channels.id as channel_id',
             'categories.name as category_name')->get();
        // 신청캠페인 디데이-신청인원 구하기  
        foreach ($applyCampaigns as $key => $loop)
		{
            $er = new Carbon($loop->end_recruit);//모집마감일
            $er = $er->addDay();
            $dif = $er->diff($nowdate)->days;//날짜차이
            $loop->rightNow = $dif; 
            $loop->applyCount = \App\CampaignReviewer::where('campaign_id',$loop->campaign_id)->count();
		}
        //        선정**캠페인
        $selectCampaigns = \App\CampaignReviewer::where('reviewer_id',$nowUser->id)
            ->where('selected',1)
            ->join('campaigns', function($join) {
                $join->on('campaign_reviewers.campaign_id','=','campaigns.id')
                    ->whereDate('end_recruit','<',Carbon::now()->toDateString())
                ->whereDate('end_submit', '>=', Carbon::now()->toDateString());
            })
            ->leftjoin('areas','campaigns.area_id','=','areas.id')
            ->leftjoin('regions','areas.region_id','=','regions.id')
            ->leftjoin('channels','channels.id','=','campaigns.channel_id')
            ->leftjoin('brands','campaigns.brand_id','=','brands.id')
            ->leftjoin('categories','categories.id','=','brands.category_id')
            ->select('campaign_reviewers.id',
            'campaign_reviewers.reviewer_id as reviewer_id',
            'campaign_reviewers.campaign_id',
            'campaign_reviewers.take_visit_check',
            'campaigns.id as campaign_id',
            'campaigns.name',
             'campaigns.form',
            'campaigns.main_image',
            'campaigns.recruit_number',
            'campaigns.offer_point',
            'campaigns.offer_goods',
            'campaigns.end_recruit',
            'campaigns.end_submit',
            'campaigns.advertiser_id',
            'areas.name as area_name',
            'regions.name as region_name',
            'channels.name as channel_name',
            'channels.id as channel_id',
             'categories.name as category_name')
            ->with('review')
            ->get();
        //        디데이-신청인원 구하기  
        foreach ($selectCampaigns as $key => $loop)
		{
             $loop->rightNow = '모집마감';
            $loop->applyCount = \App\CampaignReviewer::where('campaign_id',$loop->campaign_id)->count();
		}
        //        종료**캠페인
        $endCampaigns = \App\CampaignReviewer::where('reviewer_id',$nowUser->id)
            ->where('selected',1)
            ->join('campaigns', function($join) {
                $join->on('campaign_reviewers.campaign_id','=','campaigns.id')
                ->whereDate('end_submit', '<', Carbon::now()->toDateString());
            })
            ->leftjoin('areas','campaigns.area_id','=','areas.id')
            ->leftjoin('regions','areas.region_id','=','regions.id')
            ->leftjoin('channels','channels.id','=','campaigns.channel_id')
            ->leftjoin('brands','campaigns.brand_id','=','brands.id')
            ->leftjoin('categories','categories.id','=','brands.category_id')
            ->select('campaign_reviewers.id',
            'campaign_reviewers.reviewer_id as reviewer_id',
            'campaign_reviewers.campaign_id',
            'campaign_reviewers.take_visit_check',
            'campaigns.id as campaign_id',
            'campaigns.name',
             'campaigns.form',
            'campaigns.main_image',
            'campaigns.recruit_number',
            'campaigns.offer_point',
            'campaigns.offer_goods',
            'campaigns.end_recruit',
            'campaigns.advertiser_id',
            'areas.name as area_name',
            'regions.name as region_name',
            'channels.name as channel_name',
            'channels.id as channel_id',
             'categories.name as category_name')->with('review')->get();
        //        디데이-신청인원 구하기  
        foreach ($endCampaigns as $key => $loop)
		{
            
            $loop->applyCount = \App\CampaignReviewer::where('campaign_id',$loop->campaign_id)->count();
		}
        //채널
        $chls = \App\Channel::select('id','url')->get();
        //미제출리뷰 개수반환
        $notreview = \App\CampaignReviewer::where('reviewer_id',$nowUser->id)
            ->where('selected',1)->doesntHave('review')->join('campaigns', function($join) {
                $join->on('campaign_reviewers.campaign_id','=','campaigns.id')
                    ->whereDate('end_recruit','<',Carbon::now()->toDateString());
//                ->whereDate('end_submit', '>=', Carbon::now()->toDateString());
            })->count();
        //리뷰(어)제안 개수반환
        $suggestions = \App\ReviewerSuggestion::where('reviewer_id',$nowUser->id)->where('accept','null')->join('campaigns', function($join) {
                $join->on('reviewer_suggestions.campaign_id','=','campaigns.id')
                    ->whereDate('end_recruit','>=',Carbon::now()->toDateString());
            })->count();
        //리뷰전략열람 개수반환
        $plan = \App\Plan::where('reviewer_id',$nowUser->id)->first();
        if($plan){
            $advertiserPlans = \App\AdvertiserPlan::where('plan_id',$plan->id)->count();
        }else{
           $advertiserPlans =0; 
        }
        //관심캠페인 개수반환
        $bookmarks = \App\Bookmark::where('reviewer_id',$nowUser->id)
//            ->doesnthave('campaignReviewer')
            ->join('campaigns', function($join) {
                $join->on('bookmarks.campaign_id','=','campaigns.id')
                    ->whereDate('end_recruit','>=',Carbon::now()->toDateString());
            })
            ->count();
        return view('reviewers.mypage',[
            'user'=>$nowUser,
            'applyCampaigns'=>$applyCampaigns,
            'selectCampaigns'=>$selectCampaigns,
            'endCampaigns'=>$endCampaigns,
            'chls'=>$chls,
            'notreview'=>$notreview,
            'advertiserPlans'=>$advertiserPlans,
            'suggestions'=>$suggestions,
            'bookmarks'=>$bookmarks
        ]);
    }
    //방문 수취 확인
    public function take_visit(Request $request){
        \App\CampaignReviewer::whereId($request->id)->update(['take_visit_check'=>1]);
        return;
    }
    //리뷰 제출
    public function create_review(Request $request){
        $this->validate($request,[
            'url' => 'required|max:255',
            'after' => 'required',
        ]);
        $nowUser = auth()->user()->id;
        \App\Review::create([
            'campaign_reviewer_id'=>$request->campaign_reviewer_id,
            'url'=>$request->url,
            'after'=>$request->after,
        ]);
        //지급할 포인트 금액
        $amount = \App\Campaign::whereId($request->campaign_id)->select('offer_point')->first();
        $amount = $amount->offer_point;
        //포인트지급
        \App\Point::create([
            'campaign_id'=>$request->campaign_id,
            'reviewer_id'=>$nowUser,
            'kinds'=>'d',
            'amount'=>$amount,
        ]);
        //리뷰어개인정보에 지급된 포인트 더하기
        Reviewer::whereId($nowUser)
            ->increment('point', $amount);
        return;
    }
    //리뷰수정창 띄우기
    public function edit_review(Review $review)
    {
         return \Response::json([
            'showhtml' => \View::make('reviewers.part_edit_review', array('review' => $review))->render(),
            ]);
    }
    public function update_review(Request $request, Review $review)
    {
        $review->update($request->only('url', 'after'));
         return;
    }
    //나의캠페인
    public function my_campaign(){
        $nowUser = auth()->user()->id;
        //리뷰전략 작성 여부
        $nowUser = Reviewer::whereId($nowUser)->withCount('plan')->with('channelreviewers')->first();
        $nowdate = Carbon::now();
//        신청**캠페인
        $applyCampaigns = \App\CampaignReviewer::where('reviewer_id',$nowUser->id)
            ->join('campaigns', function($join) {
                $join->on('campaign_reviewers.campaign_id','=','campaigns.id')
                    ->whereDate('end_recruit','>=',Carbon::now()->toDateString());
            })
            ->leftjoin('areas','campaigns.area_id','=','areas.id')
            ->leftjoin('regions','areas.region_id','=','regions.id')
            ->leftjoin('channels','channels.id','=','campaigns.channel_id')
            ->leftjoin('brands','campaigns.brand_id','=','brands.id')
            ->leftjoin('categories','categories.id','=','brands.category_id')
            ->select('campaigns.id as campaign_id',
            'campaigns.name',
             'campaigns.form',
            'campaigns.main_image',
            'campaigns.recruit_number',
            'campaigns.offer_point',
            'campaigns.offer_goods',
            'campaigns.end_recruit',
            'areas.name as area_name',
            'regions.name as region_name',
            'channels.name as channel_name',
            'channels.id as channel_id',
             'categories.name as category_name')->get();
        // 신청캠페인 디데이-신청인원 구하기  
        
        foreach ($applyCampaigns as $key => $loop)
		{
            // 신청캠페인 디데이 구하기  
            $er = new Carbon($loop->end_recruit);//모집마감일
            $er = $er->addDay();
            $dif = $er->diff($nowdate)->days;//날짜차이
            $loop->rightNow = $dif; 
            //        신청인원 구하기 
            $loop->applyCount = \App\CampaignReviewer::where('campaign_id',$loop->campaign_id)->count();
		}
        //        선정**캠페인
        $selectCampaigns = \App\CampaignReviewer::where('reviewer_id',$nowUser->id)
            ->where('selected',1)
            ->with('review')
            ->join('campaigns', function($join) {
                $join->on('campaign_reviewers.campaign_id','=','campaigns.id')
                    ->whereDate('end_recruit','<',Carbon::now()->toDateString())
                ->whereDate('end_submit', '>=', Carbon::now()->toDateString());
                
            })
            ->leftjoin('areas','campaigns.area_id','=','areas.id')
            ->leftjoin('regions','areas.region_id','=','regions.id')
            ->leftjoin('channels','channels.id','=','campaigns.channel_id')
            ->leftjoin('brands','campaigns.brand_id','=','brands.id')
            ->leftjoin('categories','categories.id','=','brands.category_id')
            ->select('campaign_reviewers.id',
            'campaign_reviewers.reviewer_id as reviewer_id',
            'campaign_reviewers.campaign_id',
            'campaign_reviewers.take_visit_check',
            'campaigns.id as campaign_id',
            'campaigns.name',
             'campaigns.form',
            'campaigns.main_image',
            'campaigns.recruit_number',
            'campaigns.offer_point',
            'campaigns.offer_goods',
            'campaigns.end_recruit',
            'campaigns.end_submit',
            'campaigns.advertiser_id',
            'areas.name as area_name',
            'regions.name as region_name',
            'channels.name as channel_name',
            'channels.id as channel_id',
             'categories.name as category_name')->get();
        //        디데이-신청인원 구하기  
        foreach ($selectCampaigns as $key => $loop)
		{
            $loop->rightNow = '모집마감'; 
            //        신청인원 구하기 
            $loop->applyCount = \App\CampaignReviewer::where('campaign_id',$loop->campaign_id)->count();
		}
        //        종료**캠페인
        $endCampaigns = \App\CampaignReviewer::where('reviewer_id',$nowUser->id)
            ->where('selected',1)
            ->join('campaigns', function($join) {
                $join->on('campaign_reviewers.campaign_id','=','campaigns.id')
                ->whereDate('end_submit', '<', Carbon::now()->toDateString());
            })
            ->leftjoin('areas','campaigns.area_id','=','areas.id')
            ->leftjoin('regions','areas.region_id','=','regions.id')
            ->leftjoin('channels','channels.id','=','campaigns.channel_id')
            ->leftjoin('brands','campaigns.brand_id','=','brands.id')
            ->leftjoin('categories','categories.id','=','brands.category_id')
            ->select(
            'campaign_reviewers.id',
            'campaign_reviewers.reviewer_id as reviewer_id',
            'campaign_reviewers.campaign_id',
            'campaign_reviewers.take_visit_check',
            'campaigns.id as campaign_id',
            'campaigns.name',
             'campaigns.form',
            'campaigns.main_image',
            'campaigns.recruit_number',
            'campaigns.offer_point',
            'campaigns.offer_goods',
            'campaigns.end_recruit',
            'campaigns.advertiser_id',
            'areas.name as area_name',
            'regions.name as region_name',
            'channels.name as channel_name',
            'channels.id as channel_id',
             'categories.name as category_name')->with('review')->get();
         
        foreach ($endCampaigns as $key => $loop)
		{
            //        신청인원 구하기 
            $loop->applyCount = \App\CampaignReviewer::where('campaign_id',$loop->campaign_id)->count();
		}
        //채널
        $chls = \App\Channel::select('id','url')->get();
        return view('reviewers.mycampaign',[
            'user'=>$nowUser,
            'applyCampaigns'=>$applyCampaigns,
            'selectCampaigns'=>$selectCampaigns,
            'endCampaigns'=>$endCampaigns,
            'chls'=>$chls,
        ]);
    }
    //미제출리뷰
    public function not_submit(){
        $nowUser = auth()->user()->id;
        //리뷰전략 작성 여부
        $nowUser = Reviewer::whereId($nowUser)->withCount('plan')->with('channelreviewers')->first();
        //        미제출**캠페인
        $notSubmitCampaigns = \App\CampaignReviewer::where('reviewer_id',$nowUser->id)
            ->where('selected',1)
            ->doesntHave('review')
            ->join('campaigns', function($join) {
                $join->on('campaign_reviewers.campaign_id','=','campaigns.id')
                    ->whereDate('end_recruit','<',Carbon::now()->toDateString())
                ->whereDate('end_submit', '>=', Carbon::now()->toDateString());
            })
            ->leftjoin('areas','campaigns.area_id','=','areas.id')
            ->leftjoin('regions','areas.region_id','=','regions.id')
            ->leftjoin('channels','channels.id','=','campaigns.channel_id')
            ->leftjoin('brands','campaigns.brand_id','=','brands.id')
            ->leftjoin('categories','categories.id','=','brands.category_id')
            ->select(
            'campaign_reviewers.id',
            'campaign_reviewers.reviewer_id as reviewer_id',
            'campaign_reviewers.campaign_id',
            'campaign_reviewers.take_visit_check',
            'campaigns.id as campaign_id',
            'campaigns.name',
             'campaigns.form',
            'campaigns.main_image',
            'campaigns.recruit_number',
            'campaigns.offer_point',
            'campaigns.offer_goods',
            'campaigns.end_recruit',
            'campaigns.end_submit',
            'campaigns.advertiser_id',
            'areas.name as area_name',
            'regions.name as region_name',
            'channels.name as channel_name',
            'channels.id as channel_id',
             'categories.name as category_name')->get();
        //        디데이-신청인원 구하기  
        foreach ($notSubmitCampaigns as $key => $loop)
		{
            $loop->rightNow = '모집마감'; 
            //        신청인원 구하기 
            $loop->applyCount = \App\CampaignReviewer::where('campaign_id',$loop->campaign_id)->count();
		}
        //        캠페인 마감된 미제출**캠페인
        $end_notSubmitCampaigns = \App\CampaignReviewer::where('reviewer_id',$nowUser->id)
            ->where('selected',1)
            ->doesntHave('review')
            ->join('campaigns', function($join) {
                $join->on('campaign_reviewers.campaign_id','=','campaigns.id')
                    ->whereDate('end_submit', '<', Carbon::now()->toDateString());
            })
            ->leftjoin('areas','campaigns.area_id','=','areas.id')
            ->leftjoin('regions','areas.region_id','=','regions.id')
            ->leftjoin('channels','channels.id','=','campaigns.channel_id')
            ->leftjoin('brands','campaigns.brand_id','=','brands.id')
            ->leftjoin('categories','categories.id','=','brands.category_id')
            ->select(
            'campaign_reviewers.id',
            'campaign_reviewers.reviewer_id as reviewer_id',
            'campaign_reviewers.campaign_id',
            'campaign_reviewers.take_visit_check',
            'campaigns.id as campaign_id',
            'campaigns.name',
             'campaigns.form',
            'campaigns.main_image',
            'campaigns.recruit_number',
            'campaigns.offer_point',
            'campaigns.offer_goods',
            'campaigns.end_recruit',
            'campaigns.end_submit',
            'campaigns.advertiser_id',
            'areas.name as area_name',
            'regions.name as region_name',
            'channels.name as channel_name',
            'channels.id as channel_id',
             'categories.name as category_name')->get();
        //        디데이-신청인원 구하기  
        foreach ($end_notSubmitCampaigns as $key => $loop)
		{
            $loop->rightNow = '모집마감'; 
            //        신청인원 구하기 
            $loop->applyCount = \App\CampaignReviewer::where('campaign_id',$loop->campaign_id)->count();
		}

        //채널
        $chls = \App\Channel::select('id','url')->get();
        return view('reviewers.not_submit',[
            'user'=>$nowUser,
            'end_notSubmitCampaigns'=>$end_notSubmitCampaigns,
            'notSubmitCampaigns'=>$notSubmitCampaigns,
            'chls'=>$chls,
        ]);
    }
    //캠페인신청
     public function apply(Request $request){
         $now_reviewer = auth()->guard('web')->user()->id;
         //이미신청여부
         $pre = \App\CampaignReviewer::where('campaign_id',$request->camid)->where('reviewer_id', $now_reviewer)->first();
         //패널티여부
         $penalty = \App\Penalty::where('reviewer_id', $now_reviewer)->whereDate('fixed_date', '>=', Carbon::now()->toDateString())->orderBy('fixed_date', 'desc')->first();
         if($pre){//이미 신청한 캠페인일때
             return \Response::json(array(
                    'pre_apply' => true,
                ));
         } elseif($penalty){//패널티가 걸려있어 신청 못할 때
             return \Response::json(array(
                    'penalty' => $penalty->fixed_date,
                ));
         } else {
             $CampaignReviewer = \App\CampaignReviewer::create([
                 'campaign_id'=>$request->camid,
                 'reviewer_id'=>auth()->guard('web')->user()->id,
             ]);
             $nowUser = auth()->user()->id;
             if(isset($request->suggestId)){//리뷰어제안에서 넘어왔을 경우
                 \App\ReviewerSuggestion::whereId($request->suggestId)->update(['accept'=>'yes']);
                 //리뷰어제안 목록 만들기
                 $suggestions = \App\ReviewerSuggestion::where('reviewer_id',$nowUser)->where('accept','null')->join('campaigns', function($join) {
                $join->on('reviewer_suggestions.campaign_id','=','campaigns.id')
                    ->whereDate('end_recruit','>=',Carbon::now()->subDays(1)->toDateString());
                 })
                ->leftjoin('areas','campaigns.area_id','=','areas.id')
                ->leftjoin('regions','areas.region_id','=','regions.id')
                ->leftjoin('channels','channels.id','=','campaigns.channel_id')
                ->leftjoin('brands','campaigns.brand_id','=','brands.id')
                ->leftjoin('categories','categories.id','=','brands.category_id')
                ->select(
                'reviewer_suggestions.id as suggestion_id',
                'campaigns.id',
                'campaigns.name',
                 'campaigns.form',
                'campaigns.main_image',
                'campaigns.recruit_number',
                'campaigns.offer_point',
                'campaigns.offer_goods',
                'campaigns.end_recruit',
                'areas.name as area_name',
                'regions.name as region_name',
                'channels.name as channel_name',
                'channels.id as channel_id',
                 'categories.name as category_name')->get(); 
                 return \Response::json(array(
                     'showhtml' => \View::make('reviewers.part_suggestion', array('suggestions' => $suggestions))->render(),
                    'pre_apply' => false,
                ));
             } else if(isset($request->bookmarkId)){//관심캠페인에서 넘어왔을경우
                 \App\Bookmark::whereId($request->bookmarkId)->delete();
                 //북마크목록만들기
                 $bookmarks = \App\Bookmark::where('reviewer_id',$nowUser)
                     ->doesnthave('campaignReviewer')
                     ->join('campaigns', function($join) {
                $join->on('bookmarks.campaign_id','=','campaigns.id')
                    ->whereDate('end_recruit','>=',Carbon::now()->subDays(1)->toDateString());
            })
            ->leftjoin('areas','campaigns.area_id','=','areas.id')
            ->leftjoin('regions','areas.region_id','=','regions.id')
            ->leftjoin('channels','channels.id','=','campaigns.channel_id')
            ->leftjoin('brands','campaigns.brand_id','=','brands.id')
            ->leftjoin('categories','categories.id','=','brands.category_id')
            ->select(
            'bookmarks.id as bookmark_id',
            'campaigns.id',
            'campaigns.name',
             'campaigns.form',
            'campaigns.main_image',
            'campaigns.recruit_number',
            'campaigns.offer_point',
            'campaigns.offer_goods',
            'campaigns.end_recruit',
            'areas.name as area_name',
            'regions.name as region_name',
            'channels.name as channel_name',
            'channels.id as channel_id',
             'categories.name as category_name')->get();
                 foreach ($bookmarks as $key => $loop)
                 {
                     $er = new Carbon($loop->end_recruit);//모집마감일
                     $er = $er->addDay();
                     $dif = $er->diff($nowdate)->days;//날짜차이
                     $loop->rightNow = $dif?:'Day';
                     $loop->applyCount = \App\CampaignReviewer::where('campaign_id',$loop->id)->count();
                 }
                     return \Response::json(array(
                     'showhtml' => \View::make('reviewers.part_bookmark_list', array('bookmarks' => $bookmarks))->render(),
                    'pre_apply' => false,
                ));
             } else{
                return \Response::json(array(
                    'pre_apply' => false,
                )); 
             }
         }
    }
    //북마크등록
    public function bookmark(Request $request){
        $pre = \App\Bookmark::where('campaign_id',$request->camid)->where('reviewer_id',auth()->guard('web')->user()->id)->first();
         if($pre==null){
             $pre2 = \App\CampaignReviewer::where('campaign_id',$request->camid)->where('reviewer_id',auth()->guard('web')->user()->id)->first();
             if($pre2==null){
                 $Bookmark = \App\Bookmark::create([
                     'campaign_id'=>$request->camid,
                     'reviewer_id'=>auth()->guard('web')->user()->id,
                 ]);
                 return \Response::json(array(
                 'pre' => false,
                 ));
             } else {
                 return \Response::json(array(
                     'pre' => 'pre_apply',
                 ));
             }
         } else {
             return \Response::json(array(
                 'pre' => true,
             ));
         }
    }
    //리뷰전략열람정보
    public function plan_reading(){
        $nowUser = auth()->user()->id;
        $plan = \App\Plan::where('reviewer_id',$nowUser)->first();
        //리뷰전략 작성 여부
        $nowUser = Reviewer::whereId($nowUser)->withCount('plan')->with('channelreviewers')->first();
        $chls = \App\Channel::select('id','url')->get();
        
        if($plan!=null){
        $advertiserPlans = \App\AdvertiserPlan::where('plan_id',$plan->id)->with('advertiser')->withCount(['campaigns'=>function ($query) {
    $query->where('confirm',1)
            ->whereDate('end_recruit', '>=', Carbon::now()->subDays(1)->toDateString());
}])->get();
        } else {
            $advertiserPlans = collect();
        }

        return view('reviewers.plan_reading',[
            'user'=>$nowUser,
            'chls'=>$chls,
            'advertiserPlans'=>$advertiserPlans,
            ]);
    }
    //리뷰전략열람정보 연관 모집중캠페인 보기 Ajax
    public function show_campaign($adId){
                $recruitCampaigns = \App\Campaign::where('campaigns.advertiser_id',$adId)
            ->where('confirm',1)
            ->whereDate('end_recruit', '>=', Carbon::now()->subDays(1)->toDateString())
            ->leftjoin('areas','campaigns.area_id','=','areas.id')
            ->leftjoin('regions','regions.id','=','areas.region_id')
            ->leftjoin('channels','channels.id','=','campaigns.channel_id')
            ->leftjoin('brands','campaigns.brand_id','=','brands.id')
            ->leftjoin('categories','categories.id','=','brands.category_id')
            ->select(
            'campaigns.id',
            'campaigns.form',
            'campaigns.main_image',
            'campaigns.name',
            'campaigns.recruit_number',
            'campaigns.offer_point',
            'campaigns.offer_goods',
            'campaigns.end_recruit',
            'campaigns.created_at',
            'areas.name as area_name',
            'regions.name as region_name',
            'channels.name as channel_name',
            'channels.id as channel_id',
            'categories.name as category_name'
        )->with('campaignReviewers')->latest()->get();
//        디데이 구하기
         $nowdate = Carbon::now();  
        foreach ($recruitCampaigns as $key => $loop)
		{
            $er = new Carbon($loop->end_recruit);//모집마감일
            $er = $er->addDay();
            $dif = $er->diff($nowdate)->days;//날짜차이
            $loop->rightNow = $dif?:'Day';
            $loop->applyCount = \App\CampaignReviewer::where('campaign_id',$loop->id)->count();
		}
        return \Response::json([
            'showhtml' => \View::make('reviewers.pop_show_campaign', array('recruitCampaigns' => $recruitCampaigns))->render(),
         ]);
    }
    //리뷰어제안
    public function suggestion(){
        $nowUser = auth()->user()->id;
        //리뷰전략 작성 여부
        $nowUser = Reviewer::whereId($nowUser)->withCount('plan')->with('channelreviewers')->first();
        $chls = \App\Channel::select('id','url')->get();
        
        $suggestions = \App\ReviewerSuggestion::where('reviewer_id',$nowUser->id)->where('accept','null')->join('campaigns', function($join) {
                $join->on('reviewer_suggestions.campaign_id','=','campaigns.id')
                    ->whereDate('end_recruit','>=',Carbon::now()->toDateString());
            })
            ->leftjoin('areas','campaigns.area_id','=','areas.id')
            ->leftjoin('regions','areas.region_id','=','regions.id')
            ->leftjoin('channels','channels.id','=','campaigns.channel_id')
            ->leftjoin('brands','campaigns.brand_id','=','brands.id')
            ->leftjoin('categories','categories.id','=','brands.category_id')
            ->select(
            'reviewer_suggestions.id as suggestion_id',
            'campaigns.id',
            'campaigns.name',
             'campaigns.form',
            'campaigns.main_image',
            'campaigns.recruit_number',
            'campaigns.offer_point',
            'campaigns.offer_goods',
            'campaigns.end_recruit',
            'areas.name as area_name',
            'regions.name as region_name',
            'channels.name as channel_name',
            'channels.id as channel_id',
             'categories.name as category_name')->get(); 
        //        디데이 구하기
         $nowdate = Carbon::now();  
        foreach ($suggestions as $key => $loop)
		{
            $er = new Carbon($loop->end_recruit);//모집마감일
            $er = $er->addDay();
            $dif = $er->diff($nowdate)->days;//날짜차이
            $loop->rightNow = $dif?:'Day';
            $loop->applyCount = \App\CampaignReviewer::where('campaign_id',$loop->id)->count();
		}
        return view('reviewers.suggestion',[
            'user'=>$nowUser,
            'chls'=>$chls,
            'suggestions'=>$suggestions,
            ]);
    }//---- 리뷰어제안
    //리뷰어제안 거절
    public function no_accept($suggestId){
        $now = \App\ReviewerSuggestion::whereId($suggestId)->first();
        $now->accept = 'no';
        $now->save();
        
        $nowUser = auth()->user()->id;
        $suggestions = \App\ReviewerSuggestion::where('reviewer_id',$nowUser)->where('accept','null')->join('campaigns', function($join) {
                $join->on('reviewer_suggestions.campaign_id','=','campaigns.id')
                    ->whereDate('end_recruit','>=',Carbon::now()->subDays(1)->toDateString());
                 })
                ->leftjoin('areas','campaigns.area_id','=','areas.id')
                ->leftjoin('regions','areas.region_id','=','regions.id')
                ->leftjoin('channels','channels.id','=','campaigns.channel_id')
                ->leftjoin('brands','campaigns.brand_id','=','brands.id')
                ->leftjoin('categories','categories.id','=','brands.category_id')
                ->select(
                'reviewer_suggestions.id as suggestion_id',
                'campaigns.id',
                'campaigns.name',
                 'campaigns.form',
                'campaigns.main_image',
                'campaigns.recruit_number',
                'campaigns.offer_point',
                'campaigns.offer_goods',
                'campaigns.end_recruit',
                'areas.name as area_name',
                'regions.name as region_name',
                'channels.name as channel_name',
                'channels.id as channel_id',
                 'categories.name as category_name')->get();
        return \Response::json(array(
            'showhtml' => \View::make('reviewers.part_suggestion', array('suggestions' => $suggestions))->render(),
        ));
    }
    //관심캠페인 목록 보기
    public function bookmark_list(){
        $nowUser = auth()->user()->id;
        //리뷰전략 작성 여부
        $nowUser = Reviewer::whereId($nowUser)->withCount('plan')->with('channelreviewers')->first();
        $chls = \App\Channel::select('id','url')->get();
        
        //관심캠페인
        $bookmarks = \App\Bookmark::where('reviewer_id',$nowUser->id)
//            ->doesnthave('campaignReviewer')
            ->join('campaigns', function($join) {
                $join->on('bookmarks.campaign_id','=','campaigns.id')
                    ->whereDate('end_recruit','>=',Carbon::now()->toDateString());
            })
            ->leftjoin('areas','campaigns.area_id','=','areas.id')
            ->leftjoin('regions','areas.region_id','=','regions.id')
            ->leftjoin('channels','channels.id','=','campaigns.channel_id')
            ->leftjoin('brands','campaigns.brand_id','=','brands.id')
            ->leftjoin('categories','categories.id','=','brands.category_id')
            ->select(
            'bookmarks.id as bookmark_id',
            'campaigns.id',
            'campaigns.name',
             'campaigns.form',
            'campaigns.main_image',
            'campaigns.recruit_number',
            'campaigns.offer_point',
            'campaigns.offer_goods',
            'campaigns.end_recruit',
            'areas.name as area_name',
            'regions.name as region_name',
            'channels.name as channel_name',
            'channels.id as channel_id',
             'categories.name as category_name')->get(); 
        $nowdate = Carbon::now();  
        foreach ($bookmarks as $key => $loop)
		{
            $er = new Carbon($loop->end_recruit);//모집마감일
            $er = $er->addDay();
            $dif = $er->diff($nowdate)->days;//날짜차이
            $loop->rightNow = $dif?:'Day';
            $loop->applyCount = \App\CampaignReviewer::where('campaign_id',$loop->id)->count();
        }
        return view('reviewers.bookmark_list',[
            'user'=>$nowUser,
            'chls'=>$chls,
            'bookmarks'=>$bookmarks,
            ]);
    }
    //북마크 삭제
    public function delete_bookmark($bookmarkId){
        \App\Bookmark::whereId($bookmarkId)->delete();
        $nowUser = auth()->user()->id;
        //관심캠페인
        $bookmarks = \App\Bookmark::where('reviewer_id',$nowUser)->join('campaigns', function($join) {
                $join->on('bookmarks.campaign_id','=','campaigns.id')
                    ->whereDate('end_recruit','>=',Carbon::now()->toDateString());
            })
            ->leftjoin('areas','campaigns.area_id','=','areas.id')
            ->leftjoin('regions','areas.region_id','=','regions.id')
            ->leftjoin('channels','channels.id','=','campaigns.channel_id')
            ->leftjoin('brands','campaigns.brand_id','=','brands.id')
            ->leftjoin('categories','categories.id','=','brands.category_id')
            ->select(
            'bookmarks.id as bookmark_id',
            'campaigns.id',
            'campaigns.name',
             'campaigns.form',
            'campaigns.main_image',
            'campaigns.recruit_number',
            'campaigns.offer_point',
            'campaigns.offer_goods',
            'campaigns.end_recruit',
            'areas.name as area_name',
            'regions.name as region_name',
            'channels.name as channel_name',
            'channels.id as channel_id',
             'categories.name as category_name')->get();
        return \Response::json(array(
                     'showhtml' => \View::make('reviewers.part_bookmark_list', array('bookmarks' => $bookmarks))->render(),
                ));
    }
    public function point(){
        $nowUser = auth()->user()->id;
        //리뷰전략 작성 여부
        $nowUser = Reviewer::whereId($nowUser)->withCount('plan')->with('channelreviewers')->first();
        $chls = \App\Channel::select('id','url')->get();
        
        $points = \App\Point::where('reviewer_id',$nowUser->id)
            ->with('campaign:id,name')
//            ->join('campaigns', function($join) {
//                $join->on('points.campaign_id','=','campaigns.id');
//            })
//            ->select(
//            'points.created_at',
//            'points.kinds',
//            'points.amount',
//            'campaigns.name as campaign_name'
//        )
            ->latest()
            ->get();
        
        return view('reviewers.point',[
            'user'=>$nowUser,
            'chls'=>$chls,
            'points'=>$points,
            ]);
    }
    
    public function point_search(Request $request){
        $nowUser = auth()->user()->id;
        $start=$request->start;
        $myend=$request->myend;
        $kinds=$request->kinds;
//        $find=$request->find;
        $points = \App\Point::where('reviewer_id',$nowUser)
            ->when($start, function ($query, $start) {
                    return $query->whereDate('points.created_at', '>=', $start);
                })
            ->when($myend, function ($query, $myend) {
                    return $query->whereDate('points.created_at', '<=', $myend);
                })
            ->when($kinds, function ($query, $kinds) {
                    return $query->where('kinds', $kinds);
                })
//            ->join('campaigns', function($join) use ($find) {
//                $join->on('points.campaign_id','=','campaigns.id')
//                    ->where('name', 'like', '%'.$find.'%');
//            })
//            ->select(
//            'points.created_at',
//            'points.kinds',
//            'points.amount',
//            'campaigns.name as campaign_name'
//        )
            ->with('campaign:id,name')
            ->latest()
            ->get();
        return \Response::json(array(
                     'showhtml' => \View::make('reviewers.part_point', array('points' => $points))->render(),
                ));
    }
    
   //출금신청 
    public function withdraw(){
        $nowUser = auth()->user()->id;
        $nowUser = Reviewer::whereId($nowUser)->withCount('plan')->with('channelreviewers')->first();
        $chls = \App\Channel::select('id','url')->get();
        //은행가져오기
        $banks=\App\Bank::get();
        
        return view('reviewers.withdraw',[
            'user'=>$nowUser,
            'chls'=>$chls,
            'banks'=>$banks
            ]);
    }
    public function save_withdraw(Request $request){
        $this->validate($request,[
            'bank_id' => 'required',
            'account_holder' => 'required',
            'account_number' => 'required|numeric',
            'id_card_image' => 'required|mimes:jpeg,bmp,png,gif,svg',
            'amount' => 'required|numeric',
        ]);
        $deposit = new Deposit;
        $deposit->reviewer_id = auth()->user()->id;
        $deposit->bank_id = $request->bank_id;
        $deposit->account_holder = $request->account_holder;
        $deposit->account_number = $request->account_number;
        $deposit->amount = $request->amount;
        if($request->hasfile('id_card_image')){
            $file = $request->file('id_card_image');
            $filename = time().filter_var($file->getClientOriginalName(),FILTER_SANITIZE_URL);
            $location = 'files/id_card/'.$filename;
            $img = Image::make($file);
            $img->resize(800, null, function ($constraint) {
    $constraint->aspectRatio();
});
            $img->save($location);
            $deposit->id_card_image = $filename;
        }
        $deposit->save();
        
        $nowUser = auth()->user()->id;
        //리뷰전략 작성 여부
        $nowUser = \App\Reviewer::whereId($nowUser)->withCount('plan')->with('channelreviewers')->first();
        $chls = \App\Channel::select('id','url')->get();
        
        return view('reviewers.withdraw_end',[
            'user'=>$nowUser,
            'chls'=>$chls,
            ]);
    }
    //회원정보수정
    public function edit_info(){
        $nowUser = auth()->user()->id;
        //리뷰전략 작성 여부
        $nowUser = Reviewer::whereId($nowUser)->withCount('plan')->with('channelreviewers')->first();
        $chls = \App\Channel::select('id','url')->get();
        if($nowUser->password===null){
            return view('reviewers.edit_info2',[
            'user'=>$nowUser,
            'chls'=>$chls,
            ]);
        }else{
            return view('reviewers.edit_info',[
            'user'=>$nowUser,
            'chls'=>$chls,
            ]);
        }
    } 
    //회원정보 업데이트
    public function update_info(Request $request, Reviewer $reviewer){
        $this->validate($request,[
            'origin_pw' => ['required',
                            function ($attribute, $value, $fail) use ($reviewer) {
                                    if (!Hash::check($value, $reviewer->password)) {
                                        $fail('기존 비밀번호가 다릅니다');
                                    }
                                },
                            ],
            'name' => 'required|max:30',
            'password' => 'nullable|confirmed|min:8|regex:/^.*(?=.{2,})(?=.*[a-zA-Z])(?=.*[0-9]).*$/',
            'nickname' => 'required|max:30|unique:reviewers,nickname,'.$reviewer->id,
            'mobile_num' => 'required|digits:11',
            'birth'=>'required|date',
            'zipcode'=>'required|digits:5',
            'address'=>'required',
            'gender'=>'required'
        ]);
        
        if($request->input('password')){
            $reviewer->password = bcrypt($request->input('password'));
        }
        $reviewer->name = $request->input('name');
        $reviewer->nickname = $request->input('nickname');
        $reviewer->mobile_num = $request->input('mobile_num');
        $reviewer->birth = $request->input('birth');
        $reviewer->zipcode = $request->input('zipcode');
        $reviewer->address = $request->input('address');
        $reviewer->detail_address = $request->input('detail_address');
        $reviewer->gender = $request->input('gender');
        $reviewer->save();
        
        $nowUser = auth()->user()->id;
        //리뷰전략 작성 여부
        $nowUser = Reviewer::whereId($nowUser)->withCount('plan')->with('channelreviewers')->first();
        $chls = \App\Channel::select('id','url')->get();
        
        return view('reviewers.update_success',[
            'user'=>$nowUser,
            'chls'=>$chls,
            ]);
    }
        //소셜회원_회원정보 업데이트
    public function update_info2(Request $request, Reviewer $reviewer){
        $this->validate($request,[
            'name' => 'required|max:30',
            'nickname' => 'required|max:30|unique:reviewers,nickname,'.$reviewer->id,
            'mobile_num' => 'required|digits:11',
            'birth'=>'required|date',
            'zipcode'=>'required|digits:5',
            'address'=>'required',
            'gender'=>'required'
        ]);
        
        $reviewer->name = $request->input('name');
        $reviewer->nickname = $request->input('nickname');
        $reviewer->mobile_num = $request->input('mobile_num');
        $reviewer->birth = $request->input('birth');
        $reviewer->zipcode = $request->input('zipcode');
        $reviewer->address = $request->input('address');
        $reviewer->detail_address = $request->input('detail_address');
        $reviewer->gender = $request->input('gender');
        $reviewer->save();
        
        $nowUser = auth()->user()->id;
        //리뷰전략 작성 여부
        $nowUser = Reviewer::whereId($nowUser)->withCount('plan')->with('channelreviewers')->first();
        $chls = \App\Channel::select('id','url')->get();
        
        return view('reviewers.update_success',[
            'user'=>$nowUser,
            'chls'=>$chls,
            ]);
    }
    //mySNS
    public function mysns(){
        $nowUser = auth()->user()->id;
        //리뷰전략 작성 여부
        $nowUser = Reviewer::whereId($nowUser)->withCount('plan')->with('channelreviewers')->first();
        $chls = \App\Channel::select('id','url')->get();
//        dd($nowUser);
        
        return view('reviewers.mysns',[
            'user'=>$nowUser,
            'chls'=>$chls,
            ]);
    }
    public function update_mysns(Request $request){
        
        $nowUser = auth()->user()->id;
        $chls = \App\Channel::select('id','url')->get();
        foreach($chls as $chl){
            if($request->input($chl->id)){
                \App\ChannelReviewer::updateOrCreate(
                    ['channel_id'=>$chl->id,
                    'reviewer_id'=>$nowUser],
                    ['name'=>$request->input($chl->id)]
                );
            }
        }
        //리뷰전략 작성 여부
        $nowUser = Reviewer::whereId($nowUser)->withCount('plan')->with('channelreviewers')->first();
        
        return view('reviewers.mysns_update_success',[
            'user'=>$nowUser,
            'chls'=>$chls,
            ]);
    }
}