<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewersController extends Controller
{
    public function __construct(){
        $this->middleware('guest');
    }
    public function create(){
        return view('reviewers.create');
    }
    
    public function tempcreate(){
        return view('reviewers.temp_create');
    }
    
    public function store(Request $request){
        $this->validate($request,[
            'email' => 'required|email|max:255|unique:reviewers',
            'name' => 'required|max:30',
            'password' => 'required|confirmed|min:8|regex:/^.*(?=.{2,})(?=.*[a-zA-Z])(?=.*[0-9]).*$/',
            'nickname' => 'required|max:30|unique:reviewers',
            'mobile_num' => 'required|digits:11|unique:reviewers',
            'birth'=>'required|date',
            'zipcode'=>'required|digits:5',
            'address'=>'required',
            'gender'=>'required'
        ]);
        $reviewer = \App\Reviewer::create([
            'email'=>$request->input('email'),
            'name'=>$request->input('name'),
            'password'=>bcrypt($request->input('password')),
            'nickname'=>$request->input('nickname'),
            'mobile_num'=>$request->input('mobile_num'),
            'birth'=>$request->input('birth'),
            'zipcode'=>$request->input('zipcode'),
            'address'=>$request->input('address'),
            'detail_address'=>$request->input('detail_address'),
            'receive_agreement'=>$request->input('receive_agreement'),
            'gender'=>$request->input('gender'),
        ]);
        //sns 채널들
        $chls = [
            1=>'naver_blog',
            2=>'instagram',
            3=>'facebook',
            4=>'youtube',
            5=>'kakao',
            6=>'naver_post',
        ];
        foreach($chls as $key=>$chl){
            if($request->input($chl)){
                \App\ChannelReviewer::create([
                   'channel_id'=>$key,
                    'reviewer_id'=>$reviewer->id,
                    'name'=>$request->input($chl),
                ]);
            }
        }
        auth()->login($reviewer);
        return view('reviewers.registerok',['name'=>auth()->user()->name]);
    }
    
    //소셜가입
    public function social_store(Request $request){
        $this->validate($request,[
            'email' => 'required|email|max:255|unique:reviewers',
            'name' => 'required|max:30',
            'nickname' => 'required|max:30|unique:reviewers',
            'mobile_num' => 'required|digits:11|unique:reviewers',
            'birth'=>'required|date',
            'zipcode'=>'required|digits:5',
            'address'=>'required',
            'gender'=>'required'
        ]);
        $reviewer = \App\Reviewer::create([
            'email'=>$request->input('email'),
            'name'=>$request->input('name'),
            'nickname'=>$request->input('nickname'),
            'mobile_num'=>$request->input('mobile_num'),
            'birth'=>$request->input('birth'),
            'zipcode'=>$request->input('zipcode'),
            'address'=>$request->input('address'),
            'detail_address'=>$request->input('detail_address'),
            'receive_agreement'=>$request->input('receive_agreement'),
            'gender'=>$request->input('gender'),
        ]);
        //sns 채널들
        $chls = [
            1=>'naver_blog',
            2=>'instagram',
            3=>'facebook',
            4=>'youtube',
            5=>'kakao',
            6=>'naver_post',
        ];
        foreach($chls as $key=>$chl){
            if($request->input($chl)){
                \App\ChannelReviewer::create([
                   'channel_id'=>$key,
                    'reviewer_id'=>$reviewer->id,
                    'name'=>$request->input($chl),
                ]);
            }
        }
        auth()->login($reviewer);
        return view('reviewers.registerok',['name'=>auth()->user()->name]);
    }
    
    public function tempstore(Request $request){
        $this->validate($request,[
            'email' => 'required|email|max:255|unique:reviewers',
            'name' => 'required|max:30',
            'password' => 'required|confirmed|min:8|regex:/^.*(?=.{2,})(?=.*[a-zA-Z])(?=.*[0-9]).*$/',
            'nickname' => 'required|max:30|unique:reviewers',
            'mobile_num' => 'required|digits:11|unique:reviewers',
            'birth'=>'required|date',
            'zipcode'=>'required|digits:5',
            'address'=>'required',
            'gender'=>'required'
        ]);
        $reviewer = \App\Reviewer::create([
            'email'=>$request->input('email'),
            'name'=>$request->input('name'),
            'password'=>bcrypt($request->input('password')),
            'nickname'=>$request->input('nickname'),
            'mobile_num'=>$request->input('mobile_num'),
            'birth'=>$request->input('birth'),
            'zipcode'=>$request->input('zipcode'),
            'address'=>$request->input('address'),
            'detail_address'=>$request->input('detail_address'),
            'gender'=>$request->input('gender'),
            'receive_agreement'=>$request->input('receive_agreement'),
            'gender'=>$request->input('gender'),
        ]);
        //sns 채널들
        $chls = [
            1=>'naver_blog',
            2=>'instagram',
            3=>'facebook',
            4=>'youtube',
            5=>'kakao',
            6=>'naver_post',
        ];
        foreach($chls as $key=>$chl){
            if($request->input($chl)){
                \App\ChannelReviewer::create([
                   'channel_id'=>$key,
                    'reviewer_id'=>$reviewer->id,
                    'name'=>$request->input($chl),
                ]);
            }
        }
        auth()->login($reviewer);
        return view('reviewers.temp_registerok',['name'=>auth()->user()->name]);
    }  
    
}
