<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;


class AdvertisersSessionsController extends Controller
{
    protected $guard = 'advertiser';
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
        
        if(! auth()->guard('advertiser')->attempt($request->only('email', 'password'), $request->has('remember')) ){
            
            return back()->withInput();
        }
        return redirect()->intended();
    }
    
    public function destory()
    {
        auth()->guard('advertiser')->logout();

        return redirect(route('main'));
    }
}
