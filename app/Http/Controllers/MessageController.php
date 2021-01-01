<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Advertiser;
use App\Reviewer;
use App\Message;

class MessageController extends Controller
{
    
    public function index(Advertiser $advertiser)
    {
        return \Response::json([
            'showhtml' => \View::make('reviewers.part_chat', array('advertiser' => $advertiser))->render(),
            ]);
//        return view('reviewers.chat',['advertiser'=>$advertiser]);
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'advertiser_id' => 'required',
            'text' => 'required',
            'from_ad' => 'required',
        ]);
        $nowUser = auth()->user()->id;
//        $message = Message::create([
//            'advertiser_id'=>$request->advertiser_id,
//            'reviewer_id'=>$now,
//            'from_ad'=>$request->from_ad,
//            'text'=>$request->text,
//        ]);
        
        return response()->json([
//            'message' => $message,
            'now' => $nowUser
        ], 201);
    }
}
