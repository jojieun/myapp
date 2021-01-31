<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;
use App\Advertiser;
use App\Reviewer;
use App\Campaign;
use App\Message;
use Carbon\Carbon;
use App\Http\Controllers\SessionsController;

class MessageController extends Controller
{
    // 리뷰어입장에서 채팅
    public function index(Advertiser $advertiser, Reviewer $reviewer, Campaign $campaign)
    {
        $messages = Message::where(function($query) use ($advertiser, $reviewer, $campaign) {
            $query->where('advertiser_id', $advertiser->id);
            $query->where('reviewer_id', $reviewer->id);
            $query->where('campaign_id', $campaign->id);
        })->orderBy('created_at')->get()->groupBy(function($item) {
            return $item->created_at->format('Y-m-d');
        });
        //상대방으로부터 온 것 읽음으로 업데이트
        Message::where(function($query) use ($advertiser, $reviewer, $campaign) {
            $query->where('advertiser_id', $advertiser->id);
            $query->where('reviewer_id', $reviewer->id);
            $query->where('campaign_id', $campaign->id);
            $query->where('from_ad', 1);
        })->update(['new' => 0]);

        //오늘 날짜 표시
        $now_date = Carbon::today()->toDateString();
        if($now_date==$messages->keys()->last()){
            $now_date = false;
        } 
        return \Response::json([
            'showhtml' => \View::make('reviewers.part_chat', array('advertiser' => $advertiser, 'messages' => $messages, 'now_date'=>$now_date))->render()
            ]);
    }
    //광고주입장에서 채팅
    public function index2(Advertiser $advertiser, Reviewer $reviewer, Campaign $campaign)
    {
        $messages = Message::where(function($query) use ($advertiser, $reviewer, $campaign) {
            $query->where('advertiser_id', $advertiser->id);
            $query->where('reviewer_id', $reviewer->id);
            $query->where('campaign_id', $campaign->id);
        })->orderBy('created_at')->get()->groupBy(function($item) {
            return $item->created_at->format('Y-m-d');
        });
        //상대방으로부터 온 것 읽음으로 업데이트
        Message::where(function($query) use ($advertiser, $reviewer, $campaign) {
            $query->where('advertiser_id', $advertiser->id);
            $query->where('reviewer_id', $reviewer->id);
            $query->where('campaign_id', $campaign->id);
            $query->where('from_ad', 0);
        })->update(['new' => 0]);
        //오늘 날짜 표시
        $now_date = Carbon::today()->toDateString();
        if($now_date==$messages->keys()->last()){
            $now_date = false;
        } 
        return \Response::json([
            'showhtml' => \View::make('advertisers.part_chat', array('reviewer' => $reviewer, 'messages' => $messages, 'now_date'=>$now_date))->render(),
            ]);
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'advertiser_id' => 'required',
            'reviewer_id' => 'required',
            'campaign_id' => 'required',
            'text' => 'required',
            'from_ad' => 'required',
        ]);
        $message = Message::create([
            'advertiser_id'=>$request->advertiser_id,
            'reviewer_id'=>$request->reviewer_id,
            'campaign_id'=>$request->campaign_id,
            'from_ad'=>$request->from_ad,
            'text'=>$request->text,
        ]);
        MessageSent::dispatch($message);
        
        return response()->json([
            'text' => $message->text,
            'now' => Carbon::parse($message->created_at)->format('H:i')
        ], 201);
    }
}
