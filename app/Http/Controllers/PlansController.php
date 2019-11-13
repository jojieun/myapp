<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use App\Plan;

class PlansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reviewers.createplan', [
            'user'=>auth()->user(),
            'categories' => \App\Category::get(),
            'regions' => \App\Region::get(),
        ]);
    }
    public function tempcreate()
    {
        return view('reviewers.temp_createplan', [
            'user'=>auth()->user(),
            'categories' => \App\Category::get(),
            'regions' => \App\Region::orderBy('arraynum', 'desc')->get(),
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
        foreach($request->area as $narea){
            $newarea = new \App\AreaPlan([
               'area_id' => $narea,
                'plan_id' => $plan->id,
            ]);
            $newarea->save();
        }
        foreach($request->category as $ncategory){
            $newcate = new \App\CategoryPlan([
               'category_id' => $ncategory,
                'plan_id' => $plan->id,
            ]);
            $newcate->save();
        }
        return redirect(route('plans.showmy'), $plan->id);
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
        foreach($request->area as $narea){
            $newarea = new \App\AreaPlan([
               'area_id' => $narea,
                'plan_id' => $plan->id,
            ]);
            $newarea->save();
        }
        foreach($request->category as $ncategory){
            $newcate = new \App\CategoryPlan([
               'category_id' => $ncategory,
                'plan_id' => $plan->id,
            ]);
            $newcate->save();
        }
        return view('reviewers.temp_planok',['name'=>auth()->user()->name]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    
    //리뷰어 마이페이지 나의 리뷰전략 관리
    public function showMy($id=null)
    {
        $plan =null;
        if($id){
            $plan = \App\Plan::whereId($id);
        }
        return view('reviewers.showplan', [
            'user'=>auth()->user(),
            'plan' => $plan,
        ]);
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
