<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class ReviewerMypageController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    //    마이페이지
    public function home(){
        $nowUser = auth()->user();
//        신청캠페인
        $applyCampaigns = \App\CampaignReviewer::where('reviewer_id',$nowUser->id)
            ->join('campaigns', function($join){
                $join->on('campaign_reviewers.campaign_id','=','campaigns.id');
//                    ->where('campaigns.confirm',1);
            })
            ->leftjoin('areas','campaigns.area_id','=','areas.id')
            ->leftjoin('regions','areas.region_id','=','regions.id')
            ->leftjoin('channels','channels.id','=','campaigns.channel_id')
            ->leftjoin('brands','campaigns.brand_id','=','brands.id')
            ->leftjoin('categories','categories.id','=','brands.category_id')
            ->select('campaigns.id',
            'campaigns.name',
            'campaigns.main_image',
            'campaigns.recruit_number',
            'campaigns.offer_point',
            'campaigns.offer_goods',
            'campaigns.end_recruit',
            'areas.name as area_name',
            'regions.name as region_name',
            'channels.name as channel_name',
            'channels.id as channel_id',
             'categories.name as category_name',
                 )->get();
        //        디데이-신청인원 구하기
        $nowdate = Carbon::now();    
        foreach ($applyCampaigns as $key => $loop)
		{
            $er = new Carbon($loop->end_recruit);//모집마감일
            $dif = $er->diff($nowdate)->days;//날짜차이
            $loop->rightNow = $dif; 
            $loop->applyCount = \App\CampaignReviewer::where('campaign_id',$loop->id)->count();
		}
        
        return view('reviewers.mypage',[
            'user'=>$nowUser,
            'applyCampaigns'=>$applyCampaigns
        ]);
    }
     public function apply(Request $request){
        $CampaignReviewer = \App\CampaignReviewer::create([
            'campaign_id'=>$request->camid,
            'reviewer_id'=>auth()->guard('web')->user()->id,
        ]);
         return;
    }
}
