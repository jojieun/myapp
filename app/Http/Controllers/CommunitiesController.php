<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommunitiesRequest;
use Illuminate\Http\Request;
use App\Community;

class CommunitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth.both', ['except' => ['index', 'show']]);
    }
    
    public function index()
    {
        $communities = Community::with('reviewer','advertiser')->latest()->paginate(15);
        return view('communities.index', compact('communities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $community = new Community;
        return view('communities.create', compact('community'));
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
            'title' => 'required',
            'content' => 'required',
        ]);
        if(auth()->guard('web')->check()){
        $community = auth()->user()->communities()->create($request->all());
            }
        if(auth()->guard('advertiser')->check()){
            $community = auth()->guard('advertiser')->user()->communities()->create($request->all());
        }
        
        if(! $community){
            return back()->withInput();
        }
        return redirect(route('communities.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Community $community)
    {
        $community->view_count += 1;
        $community->save();
        return view('communities.show', compact('community'));
    }
    //댓글달기
    public function makecomment(Request $request)
    {
        if(auth()->guard('web')->check()){
        $comment = auth()->user()->comments()->create($request->all());
            }
        if(auth()->guard('advertiser')->check()){
            $comment = auth()->guard('advertiser')->user()->comments()->create($request->all());
        }
        $comments = \App\Comment::where('community_id', $request->community_id)->latest()->get();
        return \Response::json([
            'finhtml' => \View::make('communities.comments', array('comments' => $comments))->render(),
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Community $community)
    {
        return view('communities.edit', compact('community'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommunitiesRequest $request, Community $community)
    {
        $community->update($request->all());
        return redirect(route('communities.show', $community->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(\App\Community $community)
    {
        $community->delete();
        return response()->json([], 204);
    }
}
