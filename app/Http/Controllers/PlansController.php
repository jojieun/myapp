<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use App\Plan;
use Carbon\Carbon;

class PlansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //선택채널구하기
        $chl = $request->chl?:null;
        //선택카테고리구하기
        $cate = $request->cate ?:null;
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
        

        $plans = Plan::when($myarea, function($query, $myarea){
            return $query->join('area_plan', function ($join) use ($myarea) {
                    $join->on('plans.id','=','area_plan.plan_id')
                    ->whereIn('area_plan.area_id',$myarea);
                 });
        })->when($cate, function($query, $cate){
                 return $query->join('category_plan', function ($join) use ($cate) {
                    $join->on('plans.id','=','category_plan.plan_id')
                    ->whereIn('category_plan.category_id',$cate);
                 });
            })
            ->when($chl, function($query, $chl){
                 return $query->join('channel_reviewers', function ($join) use ($chl) {
                    $join->on('plans.reviewer_id', '=', 'channel_reviewers.reviewer_id')
                    ->whereIn('channel_reviewers.channel_id',$chl);
                 });
                })
            ->select(
            'plans.id',
            'plans.updated_at',
            'plans.reviewer_id',
            'plans.title'
        )
            ->distinct('plans.id')
            ->with(['categories','areas','channels','reviewer'])
            ->orderBy('plans.updated_at','desc')->paginate(60);

 
        $nowdate = Carbon::now();//오늘날짜  
        foreach ($plans as $key => $loop)
		{
            $er = new Carbon($loop->updated_at);//최종수정일
            $loop->up = $er->diffForHumans($nowdate);//날짜차이
		}
        
        if ($request->ajax()) {
            return \Response::json([
            'finhtml' => \View::make('influencers.part_list', array('plans' => $plans))->render(),
            ]);
        }
        
        return view('influencers.index', [
            'plans'=>$plans,
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
        //채널
        $chls = \App\Channel::select('id','url')->get();
        return view('reviewers.createplan', [
            'user'=>auth()->user(),
            'categories' => \App\Category::get(),
            'regions' => \App\Region::get(),
            'chls'=>$chls,
        ]);
    }
    public function tempcreate()
    {
        //채널
        $chls = \App\Channel::select('id','url')->get();
        return view('reviewers.temp_createplan', [
            'user'=>auth()->user(),
            'categories' => \App\Category::get(),
            'regions' => \App\Region::orderBy('arraynum', 'desc')->get(),
            'chls'=>$chls,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'profile_image' => 'image',
        ]);
        
        $plan = new Plan;
        $plan->reviewer_id= auth()->user()->id;
        $plan->title= $request->title;
        $plan->call_time = $request->call_time;
        $plan->reward = $request->reward;
        $plan->review_plan = $request->review_plan;
        if($request->hasfile('profile_image')){
            $file = $request->file('profile_image');
            $filename = time().filter_var($file->getClientOriginalName(),FILTER_SANITIZE_URL);
            $location = 'files/profile/'.$filename;
            $img = Image::make($file);
            $img->fit(220,220);
            $img->save($location);
            $plan->profile_image = $filename;
        }
        $plan->save();
        if($request->area){
        foreach($request->area as $narea){
            $newarea = new \App\AreaPlan([
               'area_id' => $narea,
                'plan_id' => $plan->id,
            ]);
            $newarea->save();
        }
            }
        if($request->category){
        foreach($request->category as $ncategory){
            $newcate = new \App\CategoryPlan([
               'category_id' => $ncategory,
                'plan_id' => $plan->id,
            ]);
            $newcate->save();
        }
                        }

        return redirect(route('plans.showmy', $plan->id));
    }
    
     public function tempstore(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'profile_image' => 'image',
        ]);
        
        $plan = new Plan;
        $plan->reviewer_id= auth()->user()->id;
        $plan->title= $request->title;
        $plan->call_time = $request->call_time;
        $plan->reward = $request->reward;
        $plan->review_plan = $request->review_plan;
        if($request->hasfile('profile_image')){
            $file = $request->file('profile_image');
            $filename = time().filter_var($file->getClientOriginalName(),FILTER_SANITIZE_URL);
            $location = 'files/profile/'.$filename;
            $img = Image::make($file);
            $img->fit(220,220);
            $img->save($location);
            $plan->profile_image = $filename;
        }
        $plan->save();
        if($request->area){
        foreach($request->area as $narea){
            $newarea = new \App\AreaPlan([
               'area_id' => $narea,
                'plan_id' => $plan->id,
            ]);
            $newarea->save();
        }
            }
        if($request->category){
        foreach($request->category as $ncategory){
            $newcate = new \App\CategoryPlan([
               'category_id' => $ncategory,
                'plan_id' => $plan->id,
            ]);
            $newcate->save();
        }
                        }
        return view('reviewers.temp_planok',['name'=>auth()->user()->name]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        return view('influencers.show', ['plan'=>$plan]);
    }
    
    //리뷰어 마이페이지 나의 리뷰전략 관리
    public function showMy($id)
    {

            $plan = \App\Plan::whereId($id)->first();
        //채널
        $chls = \App\Channel::select('id','url')->get();
        return view('reviewers.showplan', [
            'user'=>auth()->user(),
            'plan' => $plan,
            'chls'=>$chls,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
        //채널
        $chls = \App\Channel::select('id','url')->get();
        return view('reviewers.editplan', [
            'user'=>auth()->user(),
            'plan' => $plan,
            'chls'=>$chls,
            'categories' => \App\Category::get(),
            'regions' => \App\Region::orderBy('arraynum', 'desc')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plan $plan)
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
