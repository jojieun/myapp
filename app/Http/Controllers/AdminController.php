<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin', ['except' => ['login','store']]);
    }
    //관리자첫페이지
     public function index()
    {   
         $waitCampaigns = \App\Campaign::where('confirm',0)->with('brand')->get();
        return view('admin.index',[
            'waitCampaigns' => $waitCampaigns,
        ]);
    }
    //admin 로그인
     public function login(){
        return view('admin.login');
    }
    //admin 로그인 처리
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        
        if(! auth()->guard('admin')->attempt($request->only('email', 'password')) ){
            flash('이메일 또는 비밀번호를 확인해주세요!')->warning();
            return back()->withInput();
        }
        return redirect(route('admin'));
    }
    //로그아웃
    public function destory()
    {
        auth()->guard('admin')->logout();
        return redirect(route('admin.login'));
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
