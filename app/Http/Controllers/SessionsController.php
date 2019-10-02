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
            'password' => 'required|min:6',
        ]);
        if(! auth()->attempt($request->only('email', 'password'), $request->has('remember'))){
            return back()->withInput();
        }
        return redirect()->intended();
    }
    
    public function destory()
    {
        auth()->logout();

        return redirect(route('main'));
    }
}
