<?php

namespace App\Http\Controllers;

use App\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notices = Notice::latest()->paginate(15);
        return view('cscenters.notices.index', compact('notices'));
    }
    
    public function search(Request $request)
    {
        $notices = Notice::where('title', 'like', '%'.$request->in_search_word.'%')
            ->orderBy('updated_at','desc')->paginate(15);
        return view('cscenters.notices.index', compact('notices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notices = Notice::latest()->simplePaginate(15);
        return view('admin.notice_create', compact('notices'));
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
        $notice = Notice::create($request->only('title', 'content'));

        if(! $notice){
            return back()->withInput();
        }
        
       //공지사항 목록
        $notices = Notice::latest()->simplePaginate(15);
        return \Response::json([
            'finhtml' => \View::make('admin.part_notice', array('notices' => $notices))->render(),
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function show(Notice $notice)
    {
        $notice->view_count += 1;
        $notice->save();
        return view('cscenters.notices.show', compact('notice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function edit(Notice $notice)
    {
         return \Response::json([
            'showhtml' => \View::make('admin.part_editnotice', array('notice' => $notice))->render(),
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notice $notice)
    {
        $notice->update($request->only('title', 'content'));
        $notices = Notice::latest()->simplePaginate(15);
        return \Response::json([
            'finhtml' => \View::make('admin.part_notice', array('notices' => $notices))->render(),
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notice $notice)
    {
        $notice->delete();
        $notices = Notice::latest()->simplePaginate(15);
        return \Response::json([
            'finhtml' => \View::make('admin.part_notice', array('notices' => $notices))->render(),
            ]);
    }
}
