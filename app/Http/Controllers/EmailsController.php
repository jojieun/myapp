<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class EmailsController extends Controller
{
    /**
     * Create new password controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRemind()
    {
        return view('remind_email');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param \Illuminate\Http\Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postRemind(Request $request)
    {
        $name = $request->get('name');
        $mobile_num = $request->get('mobile_num');
        
        if($find=App\Reviewer::where('name', $name)->where('mobile_num',$mobile_num)->first()){
            return view('findemail_done', [
            'email'=>$find->email,
                'name'=>$name,
                'kind'=>'reviewer'
            ]);
        } elseif($find=App\Advertiser::where('name', $name)->where('mobile_num',$mobile_num)->first()){
            return view('findemail_done', [
            'email'=>$find->email,
                'name'=>$name,
                'kind'=>'advertiser'
            ]);
        } else{
            flash('일치하는 회원이 없습니다.')->warning();
            return back()->withInput();
        }
    }

}
