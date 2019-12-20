<?php

namespace App\Http\Controllers;

use App\Agency;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.advertiser', ['except' => ['admin_index', 'edit', 'update', 'destroy']]);
        $this->middleware('auth.admin', ['except' => ['index','create','store','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nowuser = auth()->guard('advertiser')->user();
        $agencies = Agency::where('advertiser_id',auth()->guard('advertiser')->user()->id)->latest()->get();
        return view('advertisers.agency_index', [
            'agencies'=> $agencies,
            'user'=>$nowuser,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nowuser = auth()->guard('advertiser')->user();
       $agency = new Agency;
        return view('advertisers.agency_create', [
            'agency'=> $agency,
            'user'=>$nowuser,
        ]);
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
            'title' => 'required|max:255',
            'content' => 'required',
        ]);
        $agency = auth()->guard('advertiser')->user()->agencies()->create($request->only('title','content'));
        if(! $agency){
            return back()->withInput();
        }
        return redirect(route('agency.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function show(Agency $agency)
    {
        $nowuser = auth()->guard('advertiser')->user();
        return view('advertisers.agency_show', [
            'agency'=> $agency,
            'user'=>$nowuser,
        ]);
    }
    
    
    /********* 의뢰대행 관리자 관련************/
    public function admin_index()
    {
        $agencies = Agency::latest()->get();
        return view('admin.agency', [
            'agencies'=> $agencies,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function edit(Agency $agency)
    {
         return \Response::json([
            'showhtml' => \View::make('admin.part_edit_agency', array('agency' => $agency))->render(),
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agency $agency)
    {
        $agency->update($request->only('process'));
        $agencies = Agency::latest()->get();
         return \Response::json([
            'finhtml' => \View::make('admin.part_list_agency', array('agencies' => $agencies))->render(),
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agency $agency)
    {
        //
    }
}
