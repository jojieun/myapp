<?php

namespace App\Http\Controllers;

use App\Onetoone;
use Illuminate\Http\Request;
use Image;

class OnetooneController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.both', ['except' => []]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->guard('web')->check()){
        $onetoones = Onetoone::where('reviewer_id', auth()->guard('web')->user()->id)->latest()->paginate(15);
        } else if(auth()->guard('advertiser')->check()){
            $onetoones = Onetoone::where('advertiser_id',auth()->guard('advertiser')->user()->id)->latest()->paginate(15);
        } else {
            return route('sessions.create');
        }
        return view('cscenters.onetoones.index', compact('onetoones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $onetoone = new Onetoone;
        return view('cscenters.onetoones.create', [
            'onetoone'=> $onetoone,
            'qcategories'=>\App\Qcategory::get()
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
            'qcategory_id' => 'required',
        ]);
        if(auth()->guard('web')->check()){
        $onetoone = auth()->user()->onetoones()->create($request->only('qcategory_id','title','content'));
            }
        if(auth()->guard('advertiser')->check()){
            $onetoone = auth()->guard('advertiser')->user()->onetoones()->create($request->only('qcategory_id','title','content'));
        }
        if(! $onetoone){
            return back()->withInput();
        }
        if($request->hasfile('image')){
            $file = $request->file('image');
            $filename = time().filter_var($file->getClientOriginalName(),FILTER_SANITIZE_URL);
            $location = 'files/onetoone/'.$filename;
            $img = Image::make($file);
            $img->save($location);
            $onetoone->image = $filename;
            $onetoone->save();
        };
        return redirect(route('onetoones.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Onetoone  $onetoone
     * @return \Illuminate\Http\Response
     */
    public function show(Onetoone $onetoone)
    {
        return view('cscenters.onetoones.show', compact('onetoone'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Onetoone  $onetoone
     * @return \Illuminate\Http\Response
     */
    public function edit(Onetoone $onetoone)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Onetoone  $onetoone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Onetoone $onetoone)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Onetoone  $onetoone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Onetoone $onetoone)
    {
        //
    }
    
    
}
