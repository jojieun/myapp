<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Review;

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
        $nowUser = \App\Reviewer::whereId($nowUser)->withCount('plan')->with('channelreviewers')->first();
        $nowdate = Carbon::now();
//        신청**캠페인
        $applyCampaigns = \App\CampaignReviewer::where('reviewer_id',$nowUser->id)
            ->join('campaigns', function($join) {
                $join->on('campaign_reviewers.campaign_id','=','campaigns.id')
                    ->whereDate('end_recruit','>=',Carbon::now()->subDays(1)->toDateString());
            })
            ->leftjoin('areas','campaigns.area_id','=','areas.id')
            ->leftjoin('regions','areas.region_id','=','regions.id')
            ->leftjoin('channels','channels.id','=','campaigns.channel_id')
            ->leftjoin('brands','campaigns.brand_id','=','brands.id')
            ->leftjoin('categories','categories.id','=','brands.category_id')
            ->select('campaigns.id',
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
            $dif = $er->diff($nowdate)->days;//날짜차이
            $loop->rightNow = $dif; 
            $loop->applyCount = \App\CampaignReviewer::where('campaign_id',$loop->id)->count();
		}
        //        선정**캠페인
        $selectCampaigns = \App\CampaignReviewer::where('reviewer_id',$nowUser->id)
            ->where('selected',1)
            ->join('campaigns', function($join) {
                $join->on('campaign_reviewers.campaign_id','=','campaigns.id')
                    ->whereDate('end_recruit','<',Carbon::now()->subDays(1)->toDateString())
                ->whereDate('end_submit', '>=', Carbon::now()->toDateString());
                
            })
            ->leftjoin('areas','campaigns.area_id','=','areas.id')
            ->leftjoin('regions','areas.region_id','=','regions.id')
            ->leftjoin('channels','channels.id','=','campaigns.channel_id')
            ->leftjoin('brands','campaigns.brand_id','=','brands.id')
            ->leftjoin('categories','categories.id','=','brands.category_id')
            ->select(
            'campaign_reviewers.reviewer_id as reviewer_id',
            'campaigns.id',
            'campaigns.name',
             'campaigns.form',
            'campaigns.main_image',
            'campaigns.recruit_number',
            'campaigns.offer_point',
            'campaigns.offer_goods',
            'campaigns.end_recruit',
            'campaigns.end_submit',
            'areas.name as area_name',
            'regions.name as region_name',
            'channels.name as channel_name',
            'channels.id as channel_id',
             'categories.name as category_name')->with('review')->get();
        //        디데이-신청인원 구하기  
        foreach ($selectCampaigns as $key => $loop)
		{
            $loop->applyCount = \App\CampaignReviewer::where('campaign_id',$loop->id)->count();
		}
//        dd($selectCampaigns);
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
            ->select('campaigns.id',
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
             'categories.name as category_name')->with('review')->get();
        //        디데이-신청인원 구하기  
        foreach ($endCampaigns as $key => $loop)
		{
            $loop->applyCount = \App\CampaignReviewer::where('campaign_id',$loop->id)->count();
		}
        //채널
        $chls = \App\Channel::select('id','url')->get();
        //미제출리뷰 개수반환
        $notreview = \App\CampaignReviewer::where('reviewer_id',$nowUser->id)
            ->where('selected',1)
            ->join('campaigns', function($join) {
                $join->on('campaign_reviewers.campaign_id','=','campaigns.id')
                    ->whereDate('end_recruit','<',Carbon::now()->subDays(1)->toDateString())
                ->whereDate('end_submit', '>=', Carbon::now()->toDateString());
                
            })->doesntHave('review')->count();
        return view('reviewers.mypage',[
            'user'=>$nowUser,
            'applyCampaigns'=>$applyCampaigns,
            'selectCampaigns'=>$selectCampaigns,
            'endCampaigns'=>$endCampaigns,
            'chls'=>$chls,
            'notreview'=>$notreview
        ]);
    }
    //리뷰 제출
    public function create_review(Request $request){
        $this->validate($request,[
            'url' => 'required|max:255',
            'after' => 'required',
        ]);
        $nowUser = auth()->user()->id;
        \App\Review::create([
            'campaign_id'=>$request->campaign_id,
            'reviewer_id'=>$nowUser,
            'url'=>$request->url,
            'after'=>$request->after,
        ]);
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
        $nowUser = \App\Reviewer::whereId($nowUser)->withCount('plan')->with('channelreviewers')->first();
        $nowdate = Carbon::now();
//        신청**캠페인
        $applyCampaigns = \App\CampaignReviewer::where('reviewer_id',$nowUser->id)
            ->join('campaigns', function($join) {
                $join->on('campaign_reviewers.campaign_id','=','campaigns.id')
                    ->whereDate('end_recruit','>=',Carbon::now()->subDays(1)->toDateString());
            })
            ->leftjoin('areas','campaigns.area_id','=','areas.id')
            ->leftjoin('regions','areas.region_id','=','regions.id')
            ->leftjoin('channels','channels.id','=','campaigns.channel_id')
            ->leftjoin('brands','campaigns.brand_id','=','brands.id')
            ->leftjoin('categories','categories.id','=','brands.category_id')
            ->select('campaigns.id',
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
            $dif = $er->diff($nowdate)->days;//날짜차이
            $loop->rightNow = $dif; 
            //        신청인원 구하기 
            $loop->applyCount = \App\CampaignReviewer::where('campaign_id',$loop->id)->count();
		}
        //        선정**캠페인
        $selectCampaigns = \App\CampaignReviewer::where('reviewer_id',$nowUser->id)
            ->where('selected',1)
            ->join('campaigns', function($join) {
                $join->on('campaign_reviewers.campaign_id','=','campaigns.id')
                    ->whereDate('end_recruit','<',Carbon::now()->subDays(1)->toDateString())
                ->whereDate('end_submit', '>=', Carbon::now()->toDateString());
                
            })
            ->leftjoin('areas','campaigns.area_id','=','areas.id')
            ->leftjoin('regions','areas.region_id','=','regions.id')
            ->leftjoin('channels','channels.id','=','campaigns.channel_id')
            ->leftjoin('brands','campaigns.brand_id','=','brands.id')
            ->leftjoin('categories','categories.id','=','brands.category_id')
            ->select(
            'campaign_reviewers.reviewer_id as reviewer_id',
            'campaigns.id',
            'campaigns.name',
             'campaigns.form',
            'campaigns.main_image',
            'campaigns.recruit_number',
            'campaigns.offer_point',
            'campaigns.offer_goods',
            'campaigns.end_recruit',
            'campaigns.end_submit',
            'areas.name as area_name',
            'regions.name as region_name',
            'channels.name as channel_name',
            'channels.id as channel_id',
             'categories.name as category_name')->with('review')->get();
        //        디데이-신청인원 구하기  
        foreach ($selectCampaigns as $key => $loop)
		{
            //        신청인원 구하기 
            $loop->applyCount = \App\CampaignReviewer::where('campaign_id',$loop->id)->count();
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
            ->select('campaigns.id',
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
             'categories.name as category_name')->with('review')->get();
         
        foreach ($endCampaigns as $key => $loop)
		{
            //        신청인원 구하기 
            $loop->applyCount = \App\CampaignReviewer::where('campaign_id',$loop->id)->count();
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
        $nowUser = \App\Reviewer::whereId($nowUser)->withCount('plan')->with('channelreviewers')->first();
        //        미제출**캠페인
        $notSubmitCampaigns = \App\CampaignReviewer::where('reviewer_id',$nowUser->id)
            ->where('selected',1)
            ->join('campaigns', function($join) {
                $join->on('campaign_reviewers.campaign_id','=','campaigns.id')
                    ->whereDate('end_recruit','<',Carbon::now()->subDays(1)->toDateString())
                ->whereDate('end_submit', '>=', Carbon::now()->toDateString());
                
            })
            ->leftjoin('areas','campaigns.area_id','=','areas.id')
            ->leftjoin('regions','areas.region_id','=','regions.id')
            ->leftjoin('channels','channels.id','=','campaigns.channel_id')
            ->leftjoin('brands','campaigns.brand_id','=','brands.id')
            ->leftjoin('categories','categories.id','=','brands.category_id')
            ->select(
            'campaign_reviewers.reviewer_id as reviewer_id',
            'campaigns.id',
            'campaigns.name',
             'campaigns.form',
            'campaigns.main_image',
            'campaigns.recruit_number',
            'campaigns.offer_point',
            'campaigns.offer_goods',
            'campaigns.end_recruit',
            'campaigns.end_submit',
            'areas.name as area_name',
            'regions.name as region_name',
            'channels.name as channel_name',
            'channels.id as channel_id',
             'categories.name as category_name')->doesntHave('review')->get();
        //        디데이-신청인원 구하기  
        foreach ($notSubmitCampaigns as $key => $loop)
		{
            //        신청인원 구하기 
            $loop->applyCount = \App\CampaignReviewer::where('campaign_id',$loop->id)->count();
		}
        //채널
        $chls = \App\Channel::select('id','url')->get();
        return view('reviewers.not_submit',[
            'user'=>$nowUser,
            'notSubmitCampaigns'=>$notSubmitCampaigns,
            'chls'=>$chls,
        ]);
    }
    //캠페인신청
     public function apply(Request $request){
        $pre = \App\CampaignReviewer::where('campaign_id',$request->camid)->where('reviewer_id',auth()->guard('web')->user()->id)->get();
         if($pre!=null){
             return \Response::json(array(
                    'pre_apply' => true,
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
                 $bookmarks = \App\Bookmark::where('reviewer_id',$nowUser)->join('campaigns', function($join) {
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
        $pre = \App\Bookmark::where('campaign_id',$request->camid)->where('reviewer_id',auth()->guard('web')->user()->id)->get();
         if($pre!=null){
             return;
         } else {
        $Bookmark = \App\Bookmark::create([
            'campaign_id'=>$request->camid,
            'reviewer_id'=>auth()->guard('web')->user()->id,
        ]);
         return;
             }
    }
    //리뷰전략열람정보
    public function plan_reading(){
        $nowUser = auth()->user()->id;
        $plan = \App\Plan::where('reviewer_id',$nowUser)->first();
        //리뷰전략 작성 여부
        $nowUser = \App\Reviewer::whereId($nowUser)->withCount('plan')->with('channelreviewers')->first();
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
        $plan = \App\Plan::where('reviewer_id',$nowUser)->first();
        //리뷰전략 작성 여부
        $nowUser = \App\Reviewer::whereId($nowUser)->withCount('plan')->with('channelreviewers')->first();
        $chls = \App\Channel::select('id','url')->get();
        
        $suggestions = \App\ReviewerSuggestion::where('reviewer_id',$nowUser->id)->where('accept','null')->join('campaigns', function($join) {
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
        $plan = \App\Plan::where('reviewer_id',$nowUser)->first();
        //리뷰전략 작성 여부
        $nowUser = \App\Reviewer::whereId($nowUser)->withCount('plan')->with('channelreviewers')->first();
        $chls = \App\Channel::select('id','url')->get();
        
        //관심캠페인
        $bookmarks = \App\Bookmark::where('reviewer_id',$nowUser->id)->join('campaigns', function($join) {
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
        return \Response::json(array(
                     'showhtml' => \View::make('reviewers.part_bookmark_list', array('bookmarks' => $bookmarks))->render(),
                ));
    }
}






