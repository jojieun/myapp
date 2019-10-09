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
    
    public function store(Request $request){
        $this->validate($request,[
            'email' => 'required|email|max:255|unique:reviewers',
            'name' => 'required|max:30',
            'password' => 'required|confirmed|min:8|regex:/^.*(?=.{2,})(?=.*[a-zA-Z])(?=.*[0-9]).*$/',
            'nickname' => 'required|max:30',
            'mobile_num' => 'required|digits:11',
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
            'naver_blog'=>$request->input('naver_blog'),
            'naver_post'=>$request->input('naver_post'),
            'instagram'=>$request->input('instagram'),
            'youtube'=>$request->input('youtube'),
            'facebook'=>$request->input('facebook'),
            'kakao'=>$request->input('kakao'),
            'receive_agreement'=>$request->input('receive_agreement'),
            'gender'=>$request->input('gender'),
        ]);
        auth()->login($reviewer);
        return view('reviewers.registerok',['name'=>auth()->user()->name]);
    }
    

    
    
}
