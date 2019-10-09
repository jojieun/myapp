<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewerMypageController extends Controller
{
    //    마이페이지
    public function home(){
        return view('reviewers.mypage',[
            'user'=>auth()->user(),
        ]);
    }
}
