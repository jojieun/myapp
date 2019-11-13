<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //관리자첫페이지
     public function index()
    {   
         $waitCampaigns = \App\Campaign::where('confirm',0)->with('brand')->get();
        return view('admin.index',[
            'waitCampaigns' => $waitCampaigns,
        ]);
    }
    //캠페인승인
    public static function confirmCampaign(Request $request){
      DB::table('campaigns')->where('id', $request->nowId)->update(['confirm' => 1]);
        return;
   }
    //리뷰어목록보기
    public static function reveiwerslist(){
        $reviewers = \App\Reviewer::with('plan:id,reviewer_id')->get();
        return view('admin.reviewer',[
            'reviewers'=>$reviewers,
        ]);
   }
    //리뷰전략보기
    public static function plan($id){
        $plan = \App\Plan::whereId($id)->get();
        dd($plan);
   }
    
}
