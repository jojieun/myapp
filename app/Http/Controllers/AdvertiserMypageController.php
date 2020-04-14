<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use App\Advertiser;
use App\Campaign;
use App\Exports\CampaignReviewerExport;
use Maatwebsite\Excel\Facades\Excel;


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
            ->where('check_payment',1)
            ->select('name')
            ->get();
//        리뷰어모집(선정대기)중
        $recruitCampaigns = \App\Campaign::where('advertiser_id',$nowuser->id)
            ->where('confirm',1)
            ->whereDate('end_recruit', '>=', Carbon::now()->subDay()->toDateString())
            ->select('id','name','recruit_number')
            ->with('campaignReviewers')
            ->get();
   
//        진행중
        $submitCampaigns = \App\Campaign::where('advertiser_id',$nowuser->id)
            ->where('confirm',1)
            ->whereDate('end_recruit', '<', Carbon::now()->subDay()->toDateString())
            ->whereDate('end_submit', '>=', Carbon::now()->toDateString())
            ->select('id','name','recruit_number')
            ->withCount('reviews')
            ->with(['campaignReviewers'=>function($q){
                $q->where('selected',1);
            }])
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
            ->where('check_payment',1)
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
        $beforeDay = Carbon::now()->subDay()->toDateString();
        $recruitCampaigns = \App\Campaign::where('campaigns.advertiser_id',$nowuser->id)
            ->where('confirm',1)
            ->whereDate('end_recruit', '>=', $beforeDay)
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
            if($loop->end_recruit==$beforeDay){
                $loop->rightNow = '리뷰어선정일';
            }else{
            $er = new Carbon($loop->end_recruit);//모집마감일
            $er = $er->addDay();
            $dif = $er->diff($nowdate)->days;//날짜차이
            $loop->rightNow = $dif;
                }
		}
        //        진행중
        $submitCampaigns = \App\Campaign::where('campaigns.advertiser_id',$nowuser->id)
            ->where('confirm',1)
            ->whereDate('end_recruit', '<', $beforeDay)
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
            ->withCount('reviews')
            ->with(['campaignReviewers'=>function($q){
                $q->where('selected',1);
            }])
            ->with('refund')
            ->get();
//        dd($submitCampaigns);
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
            ->with('refund')
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
        $er = $er->addDay();
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
            $sati = (int) $sati;
//            dd($sati);
            if($sati){
                $loop->sati = $sati.'%';
            } else {
                $loop->sati = '평가없음';
            }
        }
   
        $gender_f=round($gender_f/$campaignreviewers->count()*100);
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
//    public function deselect_reviewer(Request $request, Campaign $campaign){
//        if($request->selected){
//        foreach($request->selected as $selected){
//            \App\CampaignReviewer::whereId($selected)->update(['selected' => 0]);
//        }
//        }
//        return redirect()->route('advertisers.recruit_campaign', ['campaign' => $campaign]);
//    }
    public function downe($camId){
        $re = \App\CampaignReviewer::where('campaign_id',$camId)->where('selected',1)->with('reviewer')->get();
        
        Excel::download('users', function($excel) use($re) {
    $excel->sheet('Sheet 1', function($sheet) use($re) {
        $sheet->fromArray($users);
    })->export('xls');

    });
        
        //        return (new CampaignReviewerExport($camId))->download('test.xlsx');
                      }
    
    
    //진행결과보기
    public function submit_campaign(Campaign $campaign){
        $nowuser = auth()->guard('advertiser')->user();
        $campaignreviewers = \App\CampaignReviewer::where('campaign_id',$campaign->id)->where('selected',1)->with('reviewer')->get();
        //리뷰구하기
        $reviews = \App\Review::where('campaign_id',$campaign->id)->with('reviewer')->get();
        
        //리뷰제출완료 디데이 구하기
        $nowdate = Carbon::now();
        $er = new Carbon($campaign->end_submit);//리뷰제출마감일
        $er = $er->addDay();
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
        if($campaignreviewers->count()!=0){
        $gender_f=round($gender_f/$campaignreviewers->count()*100);
            } else {
            $gender_f = null;
        }
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
    //만족도평가
    public function satisfaction (Request $request){
        \App\Review::whereId($request->reviewId)->update(['satisfaction'=>$request->val]);
        return;
    }
    //미제출(신청) 포인트환불
    public function refund ($campaignId){
        $campaign = Campaign::whereId($campaignId)
            ->select('recruit_number', 'offer_point')->first();
        $recruit_number = $campaign->recruit_number;
        $review_count = \App\Review::where('campaign_id',$campaignId)->count();
        $offer_point = $campaign->offer_point;
        //환불할포인트 = (모집인원-리뷰수)*(수수료5000+제공포인트)
        $point = ($recruit_number-$review_count)*(5000+$offer_point);
        $nowuser = auth()->guard('advertiser')->user();
        //환불실행
        Advertiser::whereId($nowuser->id)->increment('point', $point);
        \App\Refund::create([
            'advertiser_id'=>$nowuser->id,
            'campaign_id'=>$campaignId,
            'point'=>$point
        ]);
        return view('advertisers.refund_complete',[
            'user'=>$nowuser,
            'personnel'=>$recruit_number-$review_count,
            'amount'=>5000+$offer_point,
            'refund_point'=>$point
        ]);
    }
}
