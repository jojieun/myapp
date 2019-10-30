<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;


class AdvertiserMypageController extends Controller
{
    //    마이페이지메인
    public function home(){
        $nowuser = auth()->guard('advertiser')->user();
//        검수중
        $waitCampaigns = \App\Campaign::where('advertiser_id',$nowuser->id)
            ->where('confirm',0)
            ->select('name')
            ->get();
//        리뷰어 선정 대기중
        $recruitCampaigns = \App\Campaign::where('advertiser_id',$nowuser->id)
            ->where('confirm',1)
            ->whereDate('end_recruit', '>=', Carbon::now()->subDays(1)->toDateString())
            ->select('name','recruit_number')
            ->get();
//        진행중
        $submitCampaigns = \App\Campaign::where('advertiser_id',$nowuser->id)
            ->where('confirm',1)
            ->whereDate('end_recruit', '<', Carbon::now()->subDays(1)->toDateString())
            ->whereDate('end_submit', '>=', Carbon::now()->toDateString())
            ->select('name','recruit_number')
            ->get();
//        완료
        $endCampaigns = \App\Campaign::where('advertiser_id',$nowuser->id)
            ->where('confirm',1)
            ->whereDate('end_submit', '<', Carbon::now()->toDateString())
            ->select('name')
            ->get();
        return view('advertisers.mypage',[
            'waitCampaigns'=>$waitCampaigns,
            'recruitCampaigns'=>$recruitCampaigns,
            'submitCampaigns'=>$submitCampaigns,
            'endCampaigns'=>$endCampaigns,
            'user'=>$nowuser,
        ]);
    }
//    캠페인관리
    public function manageCampaign(){
        $nowuser = auth()->guard('advertiser')->user();
//        dd($nowuser);
        //        검수중
        $waitCampaigns = \App\Campaign::where('campaigns.advertiser_id',$nowuser->id)
            ->where('confirm',0)
            ->leftjoin('areas','campaigns.area_id','=','areas.id')
            ->leftjoin('regions','regions.id','=','areas.region_id')
            ->leftjoin('channels','channels.id','=','campaigns.channel_id')
            ->leftjoin('brands','campaigns.brand_id','=','brands.id')
            ->leftjoin('categories','categories.id','=','brands.category_id')
            ->select(
            'campaigns.id',
            'campaigns.form',
            'campaigns.name',
            'campaigns.offer_point',
            'campaigns.offer_goods',
            'areas.name as area_name',
            'regions.name as region_name',
            'channels.name as channel_name',
            'channels.id as channel_id',
            'categories.name as category_name',
        )->get();
        
    //        리뷰어 선정 대기중
        $recruitCampaigns = \App\Campaign::where('campaigns.advertiser_id',$nowuser->id)
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
            'campaigns.name',
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
//        디데이 구하기
        $nowdate = Carbon::now();    
        foreach ($recruitCampaigns as $key => $loop)
		{
            $er = new Carbon($loop->end_recruit);//모집마감일
            $dif = $er->diff($nowdate)->days;//날짜차이
            $loop->rightNow = $dif;
		}
        //        진행중
        $submitCampaigns = \App\Campaign::where('campaigns.advertiser_id',$nowuser->id)
            ->where('confirm',1)
            ->whereDate('end_recruit', '<', Carbon::now()->subDays(1)->toDateString())
            ->whereDate('end_submit', '>=', Carbon::now()->toDateString())
            ->leftjoin('areas','campaigns.area_id','=','areas.id')
            ->leftjoin('regions','regions.id','=','areas.region_id')
            ->leftjoin('channels','channels.id','=','campaigns.channel_id')
            ->leftjoin('brands','campaigns.brand_id','=','brands.id')
            ->leftjoin('categories','categories.id','=','brands.category_id')
            ->select(
            'campaigns.id',
            'campaigns.form',
            'campaigns.name',
            'campaigns.recruit_number',
            'campaigns.offer_point',
            'campaigns.offer_goods',
            'areas.name as area_name',
            'regions.name as region_name',
            'channels.name as channel_name',
            'channels.id as channel_id',
            'categories.name as category_name',
        )->get();
//        완료
        $endCampaigns = \App\Campaign::where('campaigns.advertiser_id',$nowuser->id)
            ->where('confirm',1)
            ->whereDate('end_submit', '<', Carbon::now()->toDateString())
            ->leftjoin('areas','campaigns.area_id','=','areas.id')
            ->leftjoin('regions','regions.id','=','areas.region_id')
            ->leftjoin('channels','channels.id','=','campaigns.channel_id')
            ->leftjoin('brands','campaigns.brand_id','=','brands.id')
            ->leftjoin('categories','categories.id','=','brands.category_id')
            ->select(
            'campaigns.id',
            'campaigns.form',
            'campaigns.name',
            'campaigns.recruit_number',
            'campaigns.offer_point',
            'campaigns.offer_goods',
            'areas.name as area_name',
            'regions.name as region_name',
            'channels.name as channel_name',
            'channels.id as channel_id',
            'categories.name as category_name',
        )->get();
        return view('advertisers.managecampaign',[
            'waitCampaigns'=>$waitCampaigns,
            'recruitCampaigns'=>$recruitCampaigns,
            'submitCampaigns'=>$submitCampaigns,
            'endCampaigns'=>$endCampaigns,
            'user'=>$nowuser,
        ]);
    }
}
