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
    public function index()
    {
        $reviewerfaqs = ReviewerFaq::get();
        return view('cscenters.faqs.r_index', compact('reviewerfaqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ReviewerFaq  $reviewerFaq
     * @return \Illuminate\Http\Response
     */
    public function show(ReviewerFaq $reviewerFaq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ReviewerFaq  $reviewerFaq
     * @return \Illuminate\Http\Response
     */
    public function edit(ReviewerFaq $reviewerFaq)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReviewerFaq  $reviewerFaq
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReviewerFaq $reviewerFaq)
    {
        //
    }
}
