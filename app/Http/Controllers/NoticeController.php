<?php

namespace App\Http\Controllers;

use App\Notice;
use Illuminate\Http\Request;
use Image;

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
        $notice = new Notice;
        $notice->title = $request->title;
        $notice->content = $request->content;
        
        if($request->hasfile('image')){
            $file = $request->file('image');
            $filename = time().filter_var($file->getClientOriginalName(),FILTER_SANITIZE_URL);
            $location = 'files/notice/'.$filename;
            $img = Image::make($file);
            $img->save($location);
            $notice->image = $filename;
        };
        $notice->save();
        
        return redirect(route('notices.create'));
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
        
        $notice->title = $request->title;
        $notice->content = $request->content;
        
        if($request->hasfile('image')){
            \File::delete('files/notice/'.$notice->image);
            $file = $request->file('image');
            $filename = time().filter_var($file->getClientOriginalName(),FILTER_SANITIZE_URL);
            $location = 'files/notice/'.$filename;
            $img = Image::make($file);
            $img->save($location);
            $notice->image = $filename;
        };
        $notice->save();
        
        $notices = Notice::latest()->simplePaginate(15);
        return view('admin.notice_create', compact('notices'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notice $notice)
    {
        \File::delete('files/notice/'.$notice->image);
        $notice->delete();
        $notices = Notice::latest()->simplePaginate(15);
        return \Response::json([
            'finhtml' => \View::make('admin.part_notice', array('notices' => $notices))->render(),
            ]);
    }
}
