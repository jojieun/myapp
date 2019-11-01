<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;
use Auth;


class AdvertisersSessionsController extends Controller
{
    protected $guard = 'advertiser';
    public function __construct(){
        $this->middleware('guest',['except'=>'destory']);
    }
    public function create(){
        return view('sessions.advertiser_create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        
        if(! auth()->guard('advertiser')->attempt($request->only('email', 'password'), $request->has('remember')) ){
            flash('이메일 또는 비밀번호를 확인해주세요!')->warning();
            return back()->withInput();
        }
        return redirect(route('advertisers.mypage'));
    }
    
    public function destory()
    {
        auth()->guard('advertiser')->logout();

        return redirect(route('main'));
    }
}
