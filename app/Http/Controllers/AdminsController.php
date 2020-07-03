<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.admins')->with('admins',\App\Admin::get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email|max:255|unique:admins',
            'name' => 'required|max:30',
            'password' => 'required|confirmed|min:8|regex:/^.*(?=.{2,})(?=.*[a-zA-Z])(?=.*[0-9]).*$/',
            'mobile_num' => 'required|digits:11|unique:admins',
        ]);
        $admin = \App\Admin::create([
            'email'=>$request->input('email'),
            'name'=>$request->input('name'),
            'password'=>bcrypt($request->input('password')),
            'mobile_num'=>$request->input('mobile_num'),
        ]);
        auth()->guard('admin')->login($admin);
        return view('admin.registerok',['name'=>auth()->guard('admin')->user()->name]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(\App\Admin $admin)
    {
        return view('admin.edit')->with('admin',$admin);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, \App\Admin $admin)
    {
        $this->validate($request,[
            'origin_pw' => ['required',
                            function ($attribute, $value, $fail) use ($admin) {
                                    if (!Hash::check($value, $admin->password)) {
                                        $fail('기존 비밀번호가 다릅니다');
                                    }
                                },
                            ],
            'name' => 'required|max:30',
            'password' => 'nullable|confirmed|min:8|regex:/^.*(?=.{2,})(?=.*[a-zA-Z])(?=.*[0-9]).*$/',
            'mobile_num' => 'required|digits:11',
        ]);
        $admin->update([
            'name'=>$request->input('name'),
            'password'=>bcrypt($request->input('password')),
            'mobile_num'=>$request->input('mobile_num'),
        ]);
        return view('admin.update_ok');
    }
    //관리자 권한 수정
    public function update_authority(Request $request, \App\Admin $admin)
    {
        $admin->update([
            'authority'=>$request->input('authority')]);
        return redirect(route('admins.index'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(\App\Admin $admin)
    {
        $admin->delete();
        return redirect(route('admins.index'));
    }
    
    public function no_permission()
    {
        return view('admin.no_permission');
    }
}
