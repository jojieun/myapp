<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WelcomeController extends Controller
{
    public function tempindex(){
        auth()->logout();
        return view('temp_welcome');
    }
    public function index(){
        $nowdate = Carbon::now();//오늘날짜
//        플래티넘캠페인
        $plCampaigns = \App\CampaignExposure::where('exposure_id',1)
            ->join('campaigns', function($join) use ($nowdate){
                $join->on('campaign_exposure.campaign_id','=','campaigns.id')
                    ->where('campaigns.confirm',1)
                    ->whereDate('end_recruit','>',$nowdate);
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
        //        디데이 구하기  
        foreach ($plCampaigns as $key => $loop)
		{
            $er = new Carbon($loop->end_recruit);//모집마감일
            $dif = $er->diff($nowdate)->days;//날짜차이
            $loop->rightNow = $dif?:'Day';
            $loop->applyCount = \App\CampaignReviewer::where('campaign_id',$loop->id)->count();
		}
        
//        프라임캠페인
        $prCampaigns = \App\CampaignExposure::where('exposure_id',2)
            ->join('campaigns', function($join) use ($nowdate){
                $join->on('campaign_exposure.campaign_id','=','campaigns.id')
                    ->where('campaigns.confirm',1)
                    ->whereDate('end_recruit','>',$nowdate);
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
             'categories.name as category_name'
                 )->get();
        //        디데이 구하기   
        foreach ($prCampaigns as $key => $loop)
		{
            $er = new Carbon($loop->end_recruit);//모집마감일
            $dif = $er->diff($nowdate)->days;//날짜차이
            $loop->rightNow = $dif?:'Day';
            $loop->applyCount = \App\CampaignReviewer::where('campaign_id',$loop->id)->count();
		}
        
        //        그랜드캠페인
        $gCampaigns = \App\CampaignExposure::where('exposure_id',3)
            ->join('campaigns', function($join) use ($nowdate){
                $join->on('campaign_exposure.campaign_id','=','campaigns.id')
                    ->where('campaigns.confirm',1)
                    ->whereDate('end_recruit','>',$nowdate);
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
             'categories.name as category_name'
                 )->get();
        //        디데이 구하기  
        foreach ($gCampaigns as $key => $loop)
		{
            $er = new Carbon($loop->end_recruit);//모집마감일
            $dif = $er->diff($nowdate)->days;//날짜차이
            $loop->rightNow = $dif?:'Day';
            $loop->applyCount = \App\CampaignReviewer::where('campaign_id',$loop->id)->count();
		}
        
        return view('welcome', [
            'plCampaigns'=>$plCampaigns,
            'prCampaigns'=>$prCampaigns,
            'gCampaigns'=>$gCampaigns,
        ]);
    }
}
