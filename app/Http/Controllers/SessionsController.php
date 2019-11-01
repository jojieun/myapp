<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function __construct(){
        $this->middleware('guest',['except'=>'destory']);
    }
    public function create(){
        return view('sessions.create');
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
        return redirect()->intended(url()->previous());
    }
    
    public function destory()
    {
        auth()->logout();

        return redirect()->intended(url()->previous());
    }
}
