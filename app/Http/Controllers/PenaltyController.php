<?php

namespace App\Http\Controllers;

use App\Penalty;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PenaltyController extends Controller
{
    public function make(){
        $black_lists = \App\CampaignReviewer::where('selected', 1)
            ->whereHas('campaign',function ($query) {
                $query->whereDate('end_submit', '<', Carbon::now()->toDateString());
            })
            ->doesntHave('review')
            ->with(['reviewer:id,name,email,mobile_num','campaign:id,name,end_submit','penalty'=>function($query){
                $query->whereDate('fixed_date', '>', Carbon::now()->toDateString());
            }])
            ->latest()
            ->get();
        $nowdate = Carbon::now();//오늘날짜 
        foreach ($black_lists as $key => $loop)
		{
            $er = new Carbon($loop->campaign->end_submit);//제출마감일
            $dif = $er->diff($nowdate)->days;//날짜차이
            $loop->delay = $dif;
		}
        return \Response::json([
            'finhtml' => \View::make('admin.part_black_list', array('black_lists' => $black_lists))->render(),
        ]);
    }
    public function store(Request $request)
    {
        $now = Carbon::now();
        $fixed_date = $now->addDays($request->fixed_date);
        $penalty = Penalty::create([
            'reviewer_id'=>$request->reviewer_id,
            'fixed_date'=>$fixed_date,
        ]);
        if(! $penalty){
            return back()->withInput();
        }
        return $this->make();
    }

    //삭제
    public function delete(Penalty $penalty)
    {
        $penalty->delete();
        return $this->make();
    }
}
