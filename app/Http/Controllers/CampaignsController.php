<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Auth;
use App\Campaign;
use Image;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class CampaignsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    protected $dontFlash = ['main_image'];
    //방문캠페인 출력
    public function indexV(Request $request)
    {   
        //선택채널구하기
        $chl = $request->chl?:null;
        //선택카테고리구하기
        $cate = $request->cate ?:null;
        //정렬방법
        $myorder = $request->myorder?:'campaigns.created_at';
        //지역구하기
        if($request->myarea){
            $myarea =[$request->myarea];
            $nowmy = \App\Area::whereId($myarea)->first();
            if($nowmy->name == '전체'){
                $nowmys = \App\Area::where('region_id',$nowmy->region_id)->select('id')->get();
                $myarea =array();
                foreach($nowmys as $nowmy)
                {
                    $myarea[] = $nowmy->id;
                }
            }
        }
        else{
            $myarea = null;
        }
        
        $nowdate = Carbon::now();//오늘날짜  
        $campaigns = \App\Campaign::where('form','v')
            ->where('confirm',1)
            ->whereDate('end_recruit','>=',$nowdate)
            ->when($myarea, function($query, $myarea){
                 return $query->join('areas', function ($join) use ($myarea) {
                    $join->on('campaigns.area_id','=','areas.id')
                    ->whereIn('campaigns.area_id',$myarea);
                 });
                 }, function($query){
                     return $query->join('areas', function ($join) {
                    $join->on('campaigns.area_id','=','areas.id');
                });
            })
            ->leftjoin('regions','regions.id','=','areas.region_id')
            ->when($chl, function($query, $chl){
                 return $query->join('channels', function ($join) use ($chl) {
                    $join->on('channels.id', '=', 'campaigns.channel_id')
                    ->whereIn('campaigns.channel_id',$chl);
                 });
                }, function($query){
                     return $query->join('channels', function ($join) {
                    $join->on('channels.id', '=', 'campaigns.channel_id');
                 });
            })
            ->leftjoin('brands','campaigns.brand_id','=','brands.id')
            ->when($cate, function($query, $cate){
                 return $query->join('categories', function ($join) use ($cate) {
                    $join->on('categories.id','=','brands.category_id')
                    ->whereIn('categories.id',$cate);
                 });
            })
            ->select(
            'campaigns.id',
            'campaigns.form',
            'campaigns.name',
            'campaigns.main_image',
            'campaigns.recruit_number',
            'campaigns.offer_point',
            'campaigns.offer_goods',
            'campaigns.end_recruit',
            'campaigns.view_count',
            'areas.name as area_name',
            'regions.name as region_name',
            'channels.name as channel_name',
            'channels.id as channel_id'
        )
            ->orderBy($myorder, 'desc')
            ->paginate(60);
        
//        디데이 구하기
foreach ($campaigns as $key => $loop)
		{
            $er = new Carbon($loop->end_recruit);//모집마감일
            $dif = $er->diff($nowdate)->days;//날짜차이
            $loop->rightNow = $dif?:'Day';
             $loop->applyCount = \App\CampaignReviewer::where('campaign_id',$loop->id)->count();
		}
        
        
        if ($request->ajax()) {
            return \Response::json([
            'finhtml' => \View::make('campaigns.part_campaign', array('campaigns' => $campaigns))->render(),
            'count' => $campaigns->count(),
            ]);
        }
        return view('campaigns.visit', [
            'campaigns'=>$campaigns,
            'channels'=>\App\Channel::select('id','name')->get(),
            'categories'=>\App\Category::get(),
        ]);
    }
    //방문캠페인 재택캠페인
    public function indexH(Request $request)
    {
        //선택채널구하기
        $chl = $request->chl?:null;
        //선택카테고리구하기
        $cate = $request->cate ?:null;
        //정렬방법
        $myorder = $request->myorder?:'campaigns.created_at';
        
        $nowdate = Carbon::now();//오늘날짜  
        $campaigns = \App\Campaign::where('form','h')
            ->where('confirm',1)
            ->whereDate('end_recruit','>=',$nowdate)
            ->when($chl, function($query, $chl){
                 return $query->join('channels', function ($join) use ($chl) {
                    $join->on('channels.id', '=', 'campaigns.channel_id')
                    ->whereIn('campaigns.channel_id',$chl);
                 });
                }, function($query){
                     return $query->join('channels', function ($join) {
                    $join->on('channels.id', '=', 'campaigns.channel_id');
                 });
            })
            ->leftjoin('brands','campaigns.brand_id','=','brands.id')
            ->when($cate, function($query, $cate){
                 return $query->join('categories', function ($join) use ($cate) {
                    $join->on('categories.id','=','brands.category_id')
                    ->whereIn('categories.id',$cate);
                 });
            }, function($query){
                     return $query->join('categories', function ($join) {
                    $join->on('categories.id', '=', 'brands.category_id');
                 });
            })
            ->select(
            'campaigns.id',
            'campaigns.form',
            'campaigns.name',
            'campaigns.main_image',
            'campaigns.recruit_number',
            'campaigns.offer_point',
            'campaigns.offer_goods',
            'campaigns.end_recruit',
            'categories.name as category_name',
            'channels.name as channel_name',
            'channels.id as channel_id'
        )
            ->orderBy($myorder, 'desc')
            ->paginate(60);

//        디데이 구하기
         $nowdate = Carbon::now();    
        foreach ($campaigns as $key => $loop)
		{
            $er = new Carbon($loop->end_recruit);//모집마감일
            $dif = $er->diff($nowdate)->days;//날짜차이
            $loop->rightNow = $dif?:'Day';
             $loop->applyCount = \App\CampaignReviewer::where('campaign_id',$loop->id)->count();
		}
        
        if ($request->ajax()) {
            return \Response::json([
            'finhtml' => \View::make('campaigns.part_campaign', array('campaigns' => $campaigns))->render(),
            'count' => $campaigns->count(),
            ]);
        }
        return view('campaigns.athome', [
            'campaigns'=>$campaigns,
            'channels'=>\App\Channel::select('id','name')->get(),
            'categories'=>\App\Category::get(),
        ]);
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('campaigns.create',[
            'user'=>auth()->guard('advertiser')->user(),
            'campaigns'=>auth()->guard('advertiser')->user()->campaigns()->get(),
            'brands'=>Auth::guard('advertiser')->user()->brands()->with('category')->get(),
            'categories' => \App\Category::get(),
            'channels' => \App\Channel::get(),
            'regions' => \App\Region::orderBy('arraynum', 'desc')->get(),
            'exposures' => \App\Exposure::with(['campaignexposures' => function ($query) {
    $query->whereDate('end', '>', Carbon::now()->addDays(3)->toDateString());
}])->get(),
            'promotions' => \App\Promotion::with(['campaignpromotions' => function ($query) {
    $query->whereDate('end', '>', Carbon::now()->addDays(3)->toDateString());
}])->get(),
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //브랜드 저장
    public function brandStore(Request $request)
    {
        $this->validate($request,[
            'brand_name' => 'required|max:210',
            'category_id' => 'required',
        ]);
        $brand = \App\Brand::create([
            'name'=>$request->brand_name,
            'category_id'=>$request->category_id,
            'advertiser_id'=>auth()->guard('advertiser')->user()->id,
        ]);
//        return route('campaigns.create', ['opbrand_id' => $brand->id]);
//        return response()->json(['opbrand_id' => $brand->id]);
        
        return \Response::json([
            'finhtml' => \View::make('campaigns.brand', [
                'brands'=>Auth::guard('advertiser')->user()->brands()->with('category')->get(),
                'opbrand_id' => $brand->id
            ])->render()
        ]);
        
    }
    public function firstStore(Request $request)
    {
        $this->validate($request,[
            'brand_id' => 'required',
            'name' => 'required|max:255',
            'form' => 'required',
            'recruit_number' => 'required|numeric|max:65534',
            'offer_point' => 'required|numeric|max:4294967294',
            'offer_goods' => 'max:255',
            'channel_id' => 'required',
            'start_recruit' => 'required|date|after:today',
            'end_recruit' => "required|date|after:'.date('Y-m-d', strtotime(start_recruit. ' + 7 days'))",
            'end_submit' => "required|date|after:'.date('Y-m-d', strtotime(end_recruit. ' + 15 days'))",
        ]);
        return response()->json(['now'=>'1']);
    }
    public function secondStore(Request $request)
    {
        $this->validate($request, [
            'main_image' => 'required',
            'contact' => 'required|max:255',
            'mission' => 'max:255',
            'keyword' => 'max:255',
            'area_id' => $request->form == 'v' ?'required|numeric': '',
            'address' => $request->form == 'v' ?'required': '',
            'visit_time' => $request->form == 'v' ?'required|max:255': 'max:255',
        ], [
            'area_id.numeric'=>'캠페인지역은 필수 입력사항입니다.'
        ]);
      
        return response()->json(['now'=>'2']);
    }
    public function makeArea(Request $request){
        $nowr = $request->region;
        $myareas = \App\Region::find($nowr)->areas()->get();
        return response()->json(array('areas' => $myareas));
    }
    
    public function store(Request $request)
    {
        $campaign = new Campaign;
        $campaign->advertiser_id=auth()->guard('advertiser')->user()->id;
        $campaign->channel_id=$request->channel_id;
        $campaign->brand_id=$request->brand_id;
        $campaign->name=$request->name;
        $campaign->form=$request->form;
        $campaign->recruit_number=$request->recruit_number;
        $campaign->offer_point=$request->offer_point;
        $campaign->offer_goods=$request->offer_goods;
        $campaign->start_recruit=$request->start_recruit;
        $campaign->end_recruit=$request->end_recruit;
        $campaign->end_submit=$request->end_submit;
        $campaign->contact=$request->contact;
        $campaign->mission=$request->mission;
        $campaign->keyword=$request->keyword;
        $campaign->etc=$request->etc;
        $campaign->payment=$request->payment;
        $campaign->provide_agreement=$request->provide_agreement;
        $campaign->area_id=$request->area_id;
        $campaign->visit_time=$request->visit_time;
        $campaign->zipcode=$request->zipcode;
        $campaign->address=$request->address;
        $campaign->detail_address=$request->detail_address;
        
        if($request->hasfile('main_image')){
            $file = $request->file('main_image');
            $filename = time().filter_var($file->getClientOriginalName(),FILTER_SANITIZE_URL);
            $location = 'files/'.$filename;
            $img = Image::make($file);
            $img->fit(530,530);
            $img->save($location);
            $campaign->main_image = $filename;
        }
        if($request->hasfile('sub_image1')){
            $file = $request->file('sub_image1');
            $filename = time().filter_var($file->getClientOriginalName(),FILTER_SANITIZE_URL);
            $location = 'files/'.$filename;
            Image::make($file)->save($location);
            $campaign->sub_image1 = $filename;
        }
        if($request->hasfile('sub_image2')){
            $file = $request->file('sub_image2');
            $filename = time().filter_var($file->getClientOriginalName(),FILTER_SANITIZE_URL);
            $location = 'files/'.$filename;
            Image::make($file)->save($location);
            $campaign->sub_image2 = $filename;
        }
        if($request->hasfile('sub_image3')){
            $file = $request->file('sub_image3');
            $filename = time().filter_var($file->getClientOriginalName(),FILTER_SANITIZE_URL);
            $location = 'files/'.$filename;
            Image::make($file)->save($location);
            $campaign->sub_image3 = $filename;
        }
        $campaign -> save();
        if($request->has('exposure_id')){
        $campaignexposure = \App\CampaignExposure::create([
            'campaign_id'=>$campaign->id,
            'exposure_id'=>$request->input('exposure_id'),
        ]);
        }
        if($request->has('promotion_id')){
        $campaignpromotion = \App\CampaignPromotion::create([
            'campaign_id'=>$campaign->id,
            'promotion_id'=>$request->input('promotion_id'),
        ]);
        }
        if(! $campaign){
            return back()->withInput();
        }
        return redirect(route('campaigns.storeend'));
    }
    
    public function storeEnd()
    {
        return view('campaigns.storeend',[
            'user'=>auth()->guard('advertiser')->user(),
        ]);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign, $d, $applyCount, $locaOrCate=null)
    {
        $campaign->view_count += 1;
        $campaign->save();
        
        //추천캠페인 출력 관련
        $nowdate = Carbon::now();//오늘날짜
        if($campaign->form == 'v'){
            $recommends = \App\Campaign::where('area_id',$campaign->area_id)
                ->where('confirm',1)
                ->where('campaigns.id','!='.$campaign->id)
                ->whereDate('end_recruit','>',$nowdate)
            ->leftjoin('areas','campaigns.area_id','=','areas.id')
            ->leftjoin('regions','areas.region_id','=','regions.id')
            ->leftjoin('channels','channels.id','=','campaigns.channel_id')
            ->leftjoin('brands','campaigns.brand_id','=','brands.id')
            ->leftjoin('categories','categories.id','=','brands.category_id')
            ->select('campaigns.id',
            'campaigns.name',
            'campaigns.main_image',
                     'campaigns.form',
            'campaigns.recruit_number',
            'campaigns.offer_point',
            'campaigns.offer_goods',
            'campaigns.end_recruit',
            'areas.name as area_name',
            'regions.name as region_name',
            'channels.name as channel_name',
            'channels.id as channel_id',
             'categories.name as category_name')->take(5)->get();

        } else {
            $recommends = \App\Brand::where('category_id',$campaign->brand->category_id)
            ->join('campaigns', function($join) use ($nowdate, $campaign){
                $join->on('campaigns.brand_id','=','brands.id')
                    ->where('campaigns.confirm',1)
                    ->where('campaigns.id','!='.$campaign->id)
                    ->whereDate('end_recruit','>',$nowdate);
            })
            ->leftjoin('areas','campaigns.area_id','=','areas.id')
            ->leftjoin('regions','areas.region_id','=','regions.id')
            ->leftjoin('channels','channels.id','=','campaigns.channel_id')
//            ->leftjoin('brands','campaigns.brand_id','=','brands.id')
            ->leftjoin('categories','categories.id','=','brands.category_id')
            ->select('campaigns.id',
            'campaigns.name',
            'campaigns.main_image',
                     'campaigns.form',
            'campaigns.recruit_number',
            'campaigns.offer_point',
            'campaigns.offer_goods',
            'campaigns.end_recruit',
            'areas.name as area_name',
            'regions.name as region_name',
            'channels.name as channel_name',
            'channels.id as channel_id',
             'categories.name as category_name')->take(5)->get();
        }
        
        //        디데이 구하기
        foreach ($recommends as $key => $loop)
        {
            $er = new Carbon($loop->end_recruit);//모집마감일
            $dif = $er->diff($nowdate)->days;//날짜차이
            $loop->rightNow = $dif?:'Day';
            $loop->applyCount = \App\CampaignReviewer::where('campaign_id',$loop->id)->count();
        }
        
        
        return view('campaigns.show', [
            'campaign'=>$campaign,
            'd' =>$d,
            'locaOrCate' =>$locaOrCate,
            'reviewer_announce' => Carbon::parse($campaign->end_recruit)->addDays(1)->format('Y-m-d'),
            'start_submit' => Carbon::parse($campaign->end_recruit)->addDays(2)->format('Y-m-d'),
            'result_announce' => Carbon::parse($campaign->end_submit)->addDays(1)->format('Y-m-d'),
            'applyCount' => $applyCount,
            'recommends' => $recommends
             ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign $campaign)
    {
        return view('campaigns.edit',[
            'campaign'=>$campaign,
            'user'=>auth()->guard('advertiser')->user(),
            'campaigns'=>auth()->guard('advertiser')->user()->campaigns()->get(),
            'brands'=>Auth::guard('advertiser')->user()->brands()->with('category')->get(),
            'categories' => \App\Category::get(),
            'channels' => \App\Channel::get(),
            'regions' => \App\Region::orderBy('arraynum', 'desc')->get(),
            'exposures' => \App\Exposure::with('campaignexposures')->get(),
            'promotions' => \App\Promotion::with('campaignpromotions')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Campaign $campaign)
    {
        $this->validate($request, [
            'contact' => 'required|max:255',
            'mission' => 'max:255',
            'keyword' => 'max:255',
            'area_id' => $request->form == 'v' ?'required|numeric': '',
            'address' => $request->form == 'v' ?'required': '',
            'visit_time' => $request->form == 'v' ?'required|max:255': 'max:255',
        ], [
            'area_id.numeric'=>'캠페인지역은 필수 입력사항입니다.'
        ]);
        
        if($request->hasfile('main_image')){
            \File::delete('files/'.$campaign->main_image);
            $file = $request->file('main_image');
            $filename = time().filter_var($file->getClientOriginalName(),FILTER_SANITIZE_URL);
            $location = 'files/'.$filename;
            $img = Image::make($file);
            $img->fit(530,530);
            $img->save($location);
            $campaign->main_image = $filename;
        }
        if($request->hasfile('sub_image1')){
            \File::delete('files/'.$campaign->sub_image1);
            $file = $request->file('sub_image1');
            $filename = time().filter_var($file->getClientOriginalName(),FILTER_SANITIZE_URL);
            $location = 'files/'.$filename;
            Image::make($file)->save($location);
            $campaign->sub_image1 = $filename;
        }
        if($request->hasfile('sub_image2')){
            \File::delete('files/'.$campaign->sub_image2);
            $file = $request->file('sub_image2');
            $filename = time().filter_var($file->getClientOriginalName(),FILTER_SANITIZE_URL);
            $location = 'files/'.$filename;
            Image::make($file)->save($location);
            $campaign->sub_image2 = $filename;
        }
        if($request->hasfile('sub_image3')){
            \File::delete('files/'.$campaign->sub_image3);
            $file = $request->file('sub_image3');
            $filename = time().filter_var($file->getClientOriginalName(),FILTER_SANITIZE_URL);
            $location = 'files/'.$filename;
            Image::make($file)->save($location);
            $campaign->sub_image3 = $filename;
        }
        
        
        $campaign->update($request->except([
            'main_image',
            'sub_image1',
            'sub_image2',
            'sub_image3',
        ]));
        return view('campaigns.editend',[
            'user'=>auth()->guard('advertiser')->user(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
