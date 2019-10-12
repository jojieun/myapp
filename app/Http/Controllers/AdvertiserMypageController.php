<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdvertiserMypageController extends Controller
{
    //    마이페이지
    public function home(){
        return view('advertisers.mypage',[
            'user'=>auth()->guard('advertiser')->user(),
        ]);
    }
}
