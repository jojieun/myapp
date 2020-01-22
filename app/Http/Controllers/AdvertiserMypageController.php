<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use App\Advertiser;
use App\Campaign;


class AdvertiserMypageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.advertiser', ['except' => []]);
    }
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
            ->select('id','name','recruit_number')->with('campaignReviewers')
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
        $nowdate = Carbon::now(); 
        $nowuser = auth()->guard('advertiser')->user();
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
            'categories.name as category_name'
        )->get();
        
    //        리뷰어 모집중
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
            'categories.name as category_name'
        )->with('campaignReviewers')->get();
//        디데이 구하기
           
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
            'categories.name as category_name'
        )
            ->withCount('reviews')->get();
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
            'categories.name as category_name'
        )
            ->withCount('reviews')
            ->get();
        return view('advertisers.managecampaign',[
            'waitCampaigns'=>$waitCampaigns,
            'recruitCampaigns'=>$recruitCampaigns,
            'submitCampaigns'=>$submitCampaigns,
            'endCampaigns'=>$endCampaigns,
            'user'=>$nowuser,
        ]);
    }
    
    //    회원정보수정 화면 출력
    public function edit_info(){
        $nowuser = auth()->guard('advertiser')->user();
        return view('advertisers.edit_info',[
            'user'=>$nowuser
        ]);
    }
    public function update(Request $request, Advertiser $advertiser)
    {
        $this->validate($request,[
            'origin_pw' => ['required',
                            function ($attribute, $value, $fail) use ($advertiser) {
                                    if (!Hash::check($value, $advertiser->password)) {
                                        $fail('기존 비밀번호가 다릅니다');
                                    }
                                },
                            ],
            'name' => 'required|max:30',
            'password' => 'required|confirmed|min:8',
            'mobile_num' => 'required|digits:11',
        ]);
        $advertiser->update([
            'name'=>$request->input('name'),
            'password'=>bcrypt($request->input('password')),
            'mobile_num'=>$request->input('mobile_num'),
        ]);
        return view('advertisers.update_success',[
            'user'=>$advertiser
        ]);
    }
    
    //모집현황(리뷰어선정)
    public function recruit_campaign(Campaign $campaign){
        $nowuser = auth()->guard('advertiser')->user();
        $campaignreviewers = \App\CampaignReviewer::where('campaign_id',$campaign->id)->with('reviewer')->with('plan')->get();
        //디데이 구하기
        $nowdate = Carbon::now();
        $er = new Carbon($campaign->end_recruit);//모집마감일
        $dif = $er->diff($nowdate)->days;//날짜차이
        $campaign->rightNow = $dif;
        
        //신청리뷰어통계
        //성별
        $gender_f = 0;
        //연령
        $ages = [0,0,0,0,0];
        //지역
        $regions = [];
        //신청리뷰어정보
        foreach ($campaignreviewers as $key => $loop)
		{   
            //성별
            if($loop->reviewer->gender=='f'){
                $gender_f++;
            }
            $er = new Carbon($loop->reviewer->birth);//생일
            $dif = $er->diff($nowdate)->y;//년도차이
            $loop->age = $dif;
            //연령
            if($dif<20){
                $ages[0]++;
            } elseif($dif<30){
                $ages[1]++;
            } elseif($dif<40){
                $ages[2]++;
            } elseif($dif<50){
                $ages[3]++;
            } else{
                $ages[4]++;
            }
            //지역명
            $loop->area = explode(' ' , $loop->reviewer->address)[0];
            if($loop->area=='제주특별자치도'){
                $loop->area='제주';
            }
            //지역통계
            if(array_key_exists($loop->area, $regions)){
                $regions[$loop->area]++;
                
            } else{
                $regions[$loop->area]=1;
            }
            //리뷰어만족도
            
            $sati = \App\Review::where('reviewer_id',$loop->reviewer->id)->avg('satisfaction');
            if($sati){
                $loop->sati = $sati+'%';
            } else {
                $loop->sati = '평가없음';
            }
        }
   
        $gender_f=$gender_f/$campaignreviewers->count()*100;
        //총개수
        $r_count = $campaignreviewers->count();
        //선정대기
        $campaignreviewers1 =$campaignreviewers->reject(function ($campaignreviewers) {
            return $campaignreviewers->selected === 1;
        });
        //선정됨
        $campaignreviewers2 =$campaignreviewers->reject(function ($campaignreviewers) {
            return $campaignreviewers->selected === 0;
        });
        //선정된
        return view('advertisers.recruit_campaign',[
            'r_count'=>$r_count,
            'campaignreviewers1'=>$campaignreviewers1,
            'campaignreviewers2'=>$campaignreviewers2,
            'user'=>$nowuser,
            'campaign'=>$campaign,
            'gender_f'=>$gender_f,
            'ages'=>$ages,
            'regions'=>$regions
        ]);
    }
    //모집현황에서 리뷰전략 보기
    public function show_plan($reviewer_id){
        $plan = \App\Plan::where('reviewer_id', $reviewer_id)->first();
         return \Response::json([
            'showhtml' => \View::make('advertisers.pop_recruit_plan', array('plan' => $plan))->render(),
         ]);
    }
    //리뷰어 선정
    public function select_reviewer(Request $request, Campaign $campaign){
        if($request->selected){
        foreach($request->selected as $selected){
            \App\CampaignReviewer::whereId($selected)->update(['selected' => 1]);
        }
        }
        return redirect()->route('advertisers.recruit_campaign', ['campaign' => $campaign]);
    }
    //리뷰어 선정 해제
    public function deselect_reviewer(Request $request, Campaign $campaign){
        if($request->selected){
        foreach($request->selected as $selected){
            \App\CampaignReviewer::whereId($selected)->update(['selected' => 0]);
        }
        }
        return redirect()->route('advertisers.recruit_campaign', ['campaign' => $campaign]);
    }
    //진행결과보기
    public function submit_campaign(Campaign $campaign){
        $nowuser = auth()->guard('advertiser')->user();
        $campaignreviewers = \App\CampaignReviewer::where('campaign_id',$campaign->id)->where('selected',1)->with('reviewer')->get();
        //리뷰구하기
        $reviews = \App\Review::where('campaign_id',$campaign->id)->with('reviewer')->get();
        //리뷰제출완료 디데이 구하기
        $nowdate = Carbon::now();
        $er = new Carbon($campaign->end_submit);//모집마감일
        $dif = $er->diff($nowdate)->days;//날짜차이
        $campaign->rightNow = $dif;
        
        //선정리뷰어통계
        //성별
        $gender_f = 0;
        //연령
        $ages = [0,0,0,0,0];
        //지역
        $regions = [];
        //선정리뷰어정보
        foreach ($campaignreviewers as $key => $loop)
		{   
            //성별
            if($loop->reviewer->gender=='f'){
                $gender_f++;
            }
            $er = new Carbon($loop->reviewer->birth);//생일
            $dif = $er->diff($nowdate)->y;//년도차이
            $loop->age = $dif;
            //연령
            if($dif<20){
                $ages[0]++;
            } elseif($dif<30){
                $ages[1]++;
            } elseif($dif<40){
                $ages[2]++;
            } elseif($dif<50){
                $ages[3]++;
            } else{
                $ages[4]++;
            }
            //지역명
            $loop->area = explode(' ' , $loop->reviewer->address)[0];
            if($loop->area=='제주특별자치도'){
                $loop->area='제주';
            }
            //지역통계
            if(array_key_exists($loop->area, $regions)){
                $regions[$loop->area]++;
                
            } else{
                $regions[$loop->area]=1;
            }
        }
        //리뷰제출 리뷰어 정보
        foreach ($reviews as $key => $loop)
		{   
            $er = new Carbon($loop->reviewer->birth);//생일
            $dif = $er->diff($nowdate)->y;//년도차이
            $loop->age = $dif;
            //지역명
            $loop->area = explode(' ' , $loop->reviewer->address)[0];
            if($loop->area=='제주특별자치도'){
                $loop->area='제주';
            }
        }
        
        $gender_f=$gender_f/$campaignreviewers->count()*100;
        //총개수
        $r_count = $campaignreviewers->count();
        //선정된
        return view('advertisers.submit_campaign',[
            'r_count'=>$r_count,
            'campaignreviewers'=>$campaignreviewers,
            'reviews'=>$reviews,
            'user'=>$nowuser,
            'campaign'=>$campaign,
            'gender_f'=>$gender_f,
            'ages'=>$ages,
            'regions'=>$regions
        ]);
    }
    
}
