<?php

namespace App\Http\Controllers;

use App\ReviewerFaq;
use Illuminate\Http\Request;

class ReviewerFaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //리뷰어 자주묻는 질문 카테고리 목록
        $rfcategories = \App\ReviewerFaqCate::get();
        //현재 카테고리 자주묻는질문목록
        $nowC = $request->nowc?:($rfcategories->first()?$rfcategories->first()->id:0);
        //리뷰어 자주묻는 질문 목록
        $reviewerfaqs = ReviewerFaq::with('rFAQcategory')
            ->where('reviewer_faq_cate_id',$nowC)
            ->latest()
            ->get();
        if ($request->ajax()) {
            return \Response::json([
            'finhtml' => \View::make('cscenters.faqs.part', array('faqs' => $reviewerfaqs))->render(),
            ]);
        }
        return view('cscenters.faqs.r_index')->with('faqs',$reviewerfaqs)
            ->with('rfcategories',$rfcategories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //리뷰어 자주묻는 질문 목록
        $reviewerfaqs = ReviewerFaq::with('rFAQcategory')->latest()->get();
        //리뷰어 자주묻는 질문 카테고리 목록
        $rfcategories = \App\ReviewerFaqCate::get();
        return view('admin.reviewerfaq_create')->with('reviewerfaqs',$reviewerfaqs)
            ->with('rfcategories',$rfcategories);
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
            'question' => 'required|max:255',
            'answer' => 'required',
            'reviewer_faq_cate_id' => 'required',
        ]);
        $reviewerfaq = ReviewerFaq::create($request->all());

        if(! $reviewerfaq){
            return back()->withInput();
        }
        
       //리뷰어 자주묻는 질문 목록
        $reviewerfaqs = ReviewerFaq::with('rFAQcategory')->latest()->get();
        return \Response::json([
            'finhtml' => \View::make('admin.part_reviewerfaq', array('reviewerfaqs' => $reviewerfaqs))->render(),
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ReviewerFaq  $reviewerFaq
     * @return \Illuminate\Http\Response
     */
    public function show(ReviewerFaq $reviewerFaq)
    {
$rfcategories = \App\ReviewerFaqCate::get();
         return \Response::json([
            'showhtml' => \View::make('admin.part_makefaq', array('reviewerfaq' => $reviewerFaq, 'rfcategories'=>$rfcategories))->render(),
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ReviewerFaq  $reviewerFaq
     * @return \Illuminate\Http\Response
     */
    public function edit(ReviewerFaq $reviewerFaq)
    {
        $rfcategories = \App\ReviewerFaqCate::get();
         return \Response::json([
            'showhtml' => \View::make('admin.part_makefaq', array('reviewerfaq' => $reviewerFaq, 'rfcategories'=>$rfcategories))->render(),
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReviewerFaq  $reviewerFaq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReviewerFaq $reviewerFaq)
    {
        $reviewerFaq->update($request->all());
        $reviewerfaqs = ReviewerFaq::with('rFAQcategory')->latest()->get();
        return \Response::json([
            'finhtml' => \View::make('admin.part_reviewerfaq', array('reviewerfaqs' => $reviewerfaqs))->render(),
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReviewerFaq  $reviewerFaq
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReviewerFaq $reviewerFaq)
    {
        $reviewerFaq->delete();
        //리뷰어 자주묻는 질문 목록
        $reviewerfaqs = ReviewerFaq::with('rFAQcategory')->latest()->get();
        return \Response::json([
            'finhtml' => \View::make('admin.part_reviewerfaq', array('reviewerfaqs' => $reviewerfaqs))->render(),
            ]);
    }
    
}
