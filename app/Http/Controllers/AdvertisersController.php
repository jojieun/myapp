<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdvertisersController extends Controller
{
   protected $guard = 'advertiser';
    
    public function __construct(){
        $this->middleware('guest');
    }
    public function create(){
        
        $categories = \App\Category::get();
        return view('advertisers.create', compact('categories'));
    }
    
    public function store(Request $request){

        $this->validate($request,[
            'email' => 'required|email|max:255|unique:advertisers',
            'name' => 'required|max:30',
            'password' => 'required|confirmed|min:6',
            'mobile_num' => 'required|digits:11|unique:advertisers',
            'category_id' => 'required',
            'brand_name' => 'required|max:210'
        ]);
        
        $advertiser = \App\Advertiser::create([
            'email'=>$request->input('email'),
            'name'=>$request->input('name'),
            'password'=>bcrypt($request->input('password')),
            'mobile_num'=>$request->input('mobile_num'),
            'receive_agreement'=>$request->input('receive_agreement'),
        ]);
        
        $brand = \App\Brand::create([
            'name'=>$request->input('brand_name'),
            'category_id'=>$request->input('category_id'),
            'advertiser_id'=>$advertiser->id,
        ]);
        auth()->guard('advertiser')->login($advertiser);

        return view('advertisers.registerok',['name'=>auth()->guard('advertiser')->user()->name]);
    }
}
