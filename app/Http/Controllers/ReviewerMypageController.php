<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewerMypageController extends Controller
{
    //    마이페이지
    public function home(){
        return view('reviewers.mypage',['nickname'=>auth()->user()->nickname, 'email'=>auth()->user()->email]);
    }
}
