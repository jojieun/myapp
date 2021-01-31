<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use Carbon\Carbon;
use Session;
class SessionsController extends Controller
{
    public function __construct(){
        $this->middleware('guest',['except'=>['destory']]);
    }
    public function create(){
        return view('sessions.create');
    }
    public function get_new_message(){
        $new_messages=Message::where('reviewer_id',auth()->user()->id)->where('new',1)->where('from_ad',1)->get();
        $new_message_count=$new_messages->count();
        $new_message=$new_messages->first();
        $today = Carbon::today()->toDateString();
        if($new_message==null){
            $new_message_hash = null;
        }else if($new_message->campaign->end_submit<$today){
            $new_message_hash = '#end';
        }else{
            $new_message_hash = '#select';
        }
        session()->put('new_message_count',$new_message_count);
        session()->put('new_message_hash',$new_message_hash);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        if(! auth()->attempt($request->only('email', 'password'), $request->has('remember'))){
            flash('이메일 또는 비밀번호를 확인해주세요!<br>광고주 회원이시면 광고주 로그인창에서 로그인해주세요!')->warning();
            return back()->withInput();
        }
        $this->get_new_message();
        return redirect()->intended(route('main'));
    }
    
    public function destory()
    {
        auth()->logout();

        return redirect(route('main'));
    }
}
