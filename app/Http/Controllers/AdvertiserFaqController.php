<?php

namespace App\Http\Controllers;

use App\AdvertiserFaq;
use Illuminate\Http\Request;

class AdvertiserFaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         //광고주 자주묻는 질문 카테고리 목록
        $afcategories = \App\AdvertiserFaqCate::get();
        //현재 카테고리 자주묻는질문목록
        $nowC = $request->nowc?:($afcategories->first()?$afcategories->first()->id:0);
        //광고주 자주묻는 질문 목록
        $advertiserfaqs = AdvertiserFaq::with('aFAQcategory')
            ->where('advertiser_faq_cate_id',$nowC)
            ->latest()
            ->get();
        if ($request->ajax()) {
            return \Response::json([
            'finhtml' => \View::make('cscenters.faqs.part', array('faqs' => $advertiserfaqs))->render(),
            ]);
        }
        return view('cscenters.faqs.a_index')->with('faqs',$advertiserfaqs)
            ->with('afcategories',$afcategories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //광고주 자주묻는 질문 목록
        $advertiserfaqs = AdvertiserFaq::with('aFAQcategory')->latest()->get();
        //광고주 자주묻는 질문 카테고리 목록
        $afcategories = \App\AdvertiserFaqCate::get();
        return view('admin.advertiserfaq_create')->with('advertiserfaqs',$advertiserfaqs)
            ->with('afcategories',$afcategories);
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
            'advertiser_faq_cate_id' => 'required',
        ]);
        $advertiserfaq = AdvertiserFaq::create($request->all());

        if(! $advertiserfaq){
            return back()->withInput();
        }
        
       //광고주 자주묻는 질문 목록
        $advertiserfaqs = AdvertiserFaq::with('aFAQcategory')->latest()->get();
        return \Response::json([
            'finhtml' => \View::make('admin.part_advertiserfaq', array('advertiserfaqs' => $advertiserfaqs))->render(),
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AdvertiserFaq  $advertiserFaq
     * @return \Illuminate\Http\Response
     */
    public function show(AdvertiserFaq $advertiserFaq)
    {
        $afcategories = \App\AdvertiserFaqCate::get();
         return \Response::json([
            'showhtml' => \View::make('admin.part_amakefaq', array('advertiserfaq' => $advertiserFaq, 'afcategories'=>$afcategories))->render(),
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AdvertiserFaq  $advertiserFaq
     * @return \Illuminate\Http\Response
     */
    public function edit(AdvertiserFaq $advertiserFaq)
    {
        $afcategories = \App\AdvertiserFaqCate::get();
         return \Response::json([
            'showhtml' => \View::make('admin.part_amakefaq', array('advertiserfaq' => $advertiserFaq, 'afcategories'=>$afcategories))->render(),
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AdvertiserFaq  $advertiserFaq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdvertiserFaq $advertiserFaq)
    {
        $advertiserFaq->update($request->all());
        $advertiserfaqs = AdvertiserFaq::with('aFAQcategory')->latest()->get();
        return \Response::json([
            'finhtml' => \View::make('admin.part_advertiserfaq', array('advertiserfaqs' => $advertiserfaqs))->render(),
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AdvertiserFaq  $advertiserFaq
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdvertiserFaq $advertiserFaq)
    {
        $advertiserFaq->delete();
        //광고주 자주묻는 질문 목록
        $advertiserfaqs = AdvertiserFaq::with('aFAQcategory')->latest()->get();
        return \Response::json([
            'finhtml' => \View::make('admin.part_advertiserfaq', array('advertiserfaqs' => $advertiserfaqs))->render(),
            ]);
    }
}
