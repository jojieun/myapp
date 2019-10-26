<?php

namespace App\Http\Controllers;

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
    
    public function index()
    {
        $campaigns = \App\Campaign::where('form','v')->with('channel')->get();
        
//        디데이 구하기
        $nowdate = Carbon::now();
        $cate = \App\Category::get();
        foreach ($campaigns as $key => $loop)
		{

            $er = new Carbon($loop->end_recruit);//모집마감일
            $dif = $er->diff($nowdate)->days;//날짜차이
			$loop->rightNow = $dif<1?'Day':$dif;
//            카테고리이름구하기
//            $bcate = \App\brand::where('id',$loop->brand_id)->get();
//            $loop->catename
                 
		}
        
        return view('campaigns.visit', compact('campaigns'));
    }
    
    public function index2()
    {
        $campaigns = \App\Campaign::where('form','h')->get();
        return view('campaigns.athome', compact('campaigns'));
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
            'regions' => \App\Region::get(),
            'exposures' => \App\Exposure::with('campaignexposures')->get(),
            'promotions' => \App\Promotion::with('campaignpromotions')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        return route('campaigns.create', ['opbrand_id' => $brand->id]);
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
        $v = $this->validate($request, [
//            'main_image' => 'required',
            'contact' => 'required|max:255',
            'mission' => 'max:255',
            'keyword' => 'max:255',
            'area_id' => 'required_if:form,v',
            'address' => $request->form == 'v' ?'required': '',
            'visit_time' => $request->form == 'v' ?'required|max:255': 'max:255',
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
            $location = public_path('files/').$filename;
            $img = Image::make($file);
            $img->fit(530,530);
            $img->save($location);
            $campaign->main_image = $filename;
        }
        if($request->hasfile('sub_image1')){
            $file = $request->file('sub_image1');
            $filename = time().filter_var($file->getClientOriginalName(),FILTER_SANITIZE_URL);
            $location = public_path('files/').$filename;
            Image::make($file)->save($location);
            $campaign->sub_image1 = $filename;
        }
        if($request->hasfile('sub_image2')){
            $file = $request->file('sub_image2');
            $filename = time().filter_var($file->getClientOriginalName(),FILTER_SANITIZE_URL);
            $location = public_path('files/').$filename;
            Image::make($file)->save($location);
            $campaign->sub_image2 = $filename;
        }
        if($request->hasfile('sub_image3')){
            $file = $request->file('sub_image3');
            $filename = time().filter_var($file->getClientOriginalName(),FILTER_SANITIZE_URL);
            $location = public_path('files/').$filename;
            Image::make($file)->save($location);
            $campaign->sub_image3 = $filename;
        }
        $campaign -> save();
        
        $campaignexposure = \App\CampaignExposure::create([
            'campaign_id'=>$campaign->id,
            'exposure_id'=>$request->input('exposure_id'),
        ]);
        $campaignpromotion = \App\CampaignPromotion::create([
            'campaign_id'=>$campaign->id,
            'promotion_id'=>$request->input('promotion_id'),
        ]);
        if(! $campaign || ! $campaignexposure || ! $campaignpromotion){
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
    public function show($id)
    {
        return view('campaigns.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
