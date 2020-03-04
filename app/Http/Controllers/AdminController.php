<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Onetoone;
use App\ReviewerFaqCate;
use App\AdvertiserFaqCate;
use App\Campaign;
use App\Qcategory;
use App\Exposure;
use App\Promotion;
use App\CampaignExposure;
use App\CampaignPromotion;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin', ['except' => ['login','store']]);
    }
    //관리자첫페이지
     public function index()
    {   
        return view('admin.index');
    }
    //admin 로그인
     public function login(){
        return view('admin.login');
    }
    //admin 로그인 처리
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        
        if(! auth()->guard('admin')->attempt($request->only('email', 'password')) ){
            flash('이메일 또는 비밀번호를 확인해주세요!')->warning();
            return back()->withInput();
        }
        return redirect()->intended(route('admin'));
    }
    //로그아웃
    public function destory()
    {
        auth()->guard('admin')->logout();
        return redirect(route('admin.login'));
    }
    
    //리뷰어목록보기
    public static function reveiwerslist(){
        $reviewers = \App\Reviewer::with(['plan:id,reviewer_id', 'channelreviewers:id,reviewer_id'])->orderBy('reviewers.created_at','desc')->paginate(50);
        return view('admin.reviewer')->with('reviewers',$reviewers);
   }
    //리뷰전략보기
    public static function plan($id){
        $plan = \App\Plan::whereId($id)->first();
         return \Response::json([
            'showhtml' => \View::make('admin.part_plan', array('plan' => $plan))->render(),
            ]);
   }
    //리뷰어 sns 보기
    public static function sns($reviewerid){
        $snss = \App\ChannelReviewer::where('reviewer_id',$reviewerid)->with('channel')->get();
         return \Response::json([
            'showhtml' => \View::make('admin.part_sns', array('snss' => $snss))->render(),
            ]);
   }
    //광고주목록보기
    public static function advertisers(){
        $advertisers = \App\Advertiser::simplePaginate(30);
        return view('admin.advertisers',[
            'advertisers'=>$advertisers,
        ]);
   }
    
    //**********캠페인
    //캠페인검수대기목록
     public function waitConfirmCam()
    {   
         $waitCampaigns = \App\Campaign::where('confirm',0)->select('id','brand_id','created_at','name')->with('brand')->get();
        return view('admin.waitcam',[
            'waitCampaigns' => $waitCampaigns,
        ]);
    }
    //검수대기캠페인자세히보기
    public static function showwait(Campaign $campaign){
         return \Response::json([
            'showhtml' => \View::make('admin.part_showwait', array('campaign' => $campaign))->render(),
            ]);
   }
    //캠페인승인
    public static function confirmCampaign(Request $request){
        $nowCamId = $request->nowId;
      \App\Campaign::where('id', $nowCamId)->update(['confirm' => 1]);
//        \App\CampaignExposure::where('campaign_id',$nowCamId)->update
        $waitCampaigns = \App\Campaign::where('confirm',0)->select('id','brand_id','created_at','name')->with('brand')->get();
        return \Response::json([
            'finhtml' => \View::make('admin.part_waitcam', array('waitCampaigns' => $waitCampaigns))->render(),
            ]);
   }
    
    //캠페인 노출옵션 구매내역
    public function exposure_purchase()
    {
        $exposure_purchases= CampaignExposure::with('campaign:id,name')->with('exposure:id,name')->get();
        return view('admin.exposure_purchase',[
            'exposure_purchases' => $exposure_purchases,
        ]);
    }
    //캠페인 홍보옵션 구매내역
    public function promotion_purchase()
    {
        $promotion_purchases= CampaignPromotion::with('campaign:id,name')->with('promotion:id,name')->get();
        return view('admin.promotion_purchase',[
            'promotion_purchases' => $promotion_purchases,
        ]);
    }
    
    //캠페인 노출 옵션 설정
    public function exposure()
    {
        $exposures= Exposure::get();
        return view('admin.exposure',[
            'exposures' => $exposures,
        ]);
    }
    //캠페인 노출 옵션 수정 열기
    public function edit_exposure(Exposure $exposure)
    {
        return \Response::json([
            'finhtml' => \View::make('admin.edit_exposure', array('exposure' => $exposure))->render(),
            ]);
    }
    //캠페인 노출 옵션 업데이트
    public function update_exposure(Request $request, Exposure $exposure)
    {
        $exposure->update($request->only('name','price','limit','instruction'));
        return redirect(route('admin.exposure'));
    }
    //캠페인 홍보 옵션 설정
    public function promotion()
    {
        $promotions= Promotion::get();
        return view('admin.promotion',[
            'promotions' => $promotions,
        ]);
    }
    //캠페인 홍보 옵션 수정 열기
    public function edit_promotion(Promotion $promotion)
    {
        return \Response::json([
            'finhtml' => \View::make('admin.edit_promotion', array('promotion' => $promotion))->render(),
            ]);
    }
    //캠페인 홍보 옵션 업데이트
    public function update_promotion(Request $request, Promotion $promotion)
    {
        $promotion->update($request->only('name','price','limit','instruction'));
        return redirect(route('admin.promotion'));
    }
    
    //일대일문의 카테고리 보기
    public function showQCategory()
    {
        $qcategories= QCategory::get();
        return view('admin.qcategory',[
            'qcategories' => $qcategories,
        ]);
    }
    //일대일문의 카테고리 만들기
    public function makeQCategory(Request $request)
    {
        
        $this->validate($request,[
            'name' => 'required|max:255',
        ]);
        $newqcategory = Qcategory::create($request->only('name'));

        if(! $newqcategory){
            return back()->withInput();
        }
        
        $qcategories=QCategory::get();
        return \Response::json([
            'finhtml' => \View::make('admin.part_qcategory', array('qcategories' => $qcategories))->render(),
            ]);
    }
    //일대일문의 카테고리 삭제
    public function delQCategory($id)
    {
        QCategory::find($id)->delete($id);
        $qcategories=QCategory::get();
        return \Response::json([
            'finhtml' => \View::make('admin.part_qcategory', array('qcategories' => $qcategories))->render(),
            ]);
    }
    //미답변 1:1문의 목록
    public function notAnswerO()
    {
        $onetoones = Onetoone::where('answer',null)->select('id','title','qcategory_id','reviewer_id','advertiser_id','created_at')
            ->with('qcategory','reviewer','advertiser')->get();
        return view('admin.notanswer', ['onetoones'=>$onetoones]);
    }

//미답변 1:1문의 답변창열기
    public function openAnswer($id)
    {
        $onetoone = Onetoone::whereId($id)->with('qcategory','reviewer','advertiser')->first();
         return \Response::json([
            'showhtml' => \View::make('admin.part_showanswer', array('onetoone' => $onetoone))->render(),
            ]);
    }
    //답변 저장, 미답변 1:1문의 목록출력
    public function saveAnswer(Request $request, Onetoone $onetoone)
    {
        $onetoone->update($request->only('answer_title','answer'));
        $onetoones = Onetoone::where('answer',null)->select('id','title','qcategory_id','reviewer_id','advertiser_id','created_at')
            ->with('qcategory','reviewer','advertiser')->get();
         return \Response::json([
            'finhtml' => \View::make('admin.part_list_answer', array('onetoones' => $onetoones))->render(),
            ]);
    }
    //답변완료 1:1문의 목록
    public function AnswerO()
    {
        $onetoones = Onetoone::where('answer','!=',null)->select('id','title','qcategory_id','reviewer_id','advertiser_id','answer_title','created_at','updated_at')
            ->with('qcategory','reviewer','advertiser')->get();
        return view('admin.answer', ['onetoones'=>$onetoones]);
    }
    //답변 새로 저장 후 답변완료 1:1목록 출력
    public function saveAnswer2 (Request $request, Onetoone $onetoone)
    {
        $onetoone->update($request->only('answer_title','answer'));
        $onetoones = Onetoone::where('answer','!=',null)->select('id','title','qcategory_id','reviewer_id','advertiser_id','created_at')
            ->with('qcategory','reviewer','advertiser')->get();
         return \Response::json([
            'finhtml' => \View::make('admin.part_list_answer2', array('onetoones' => $onetoones))->render(),
            ]);
    }
    
    //****리뷰어포인트출금
    //관리자-포인트 출금신청내역
    public function apply_deposits()
    {
        $apply_deposits = \App\Deposit::where('complete',false)->with('reviewer:id,name,mobile_num')->with('bank')->get();
        return view('admin.apply_deposits',[
            'apply_deposits' => $apply_deposits,
        ]);
    }
    //관리자-포인트 출금신청처리
    public function process_deposits(Request $request)
    {
        //입금완료처리
        \App\Deposit::whereId($request->depositId)
            ->update(['complete'=>true]);
        //리뷰어포인트감소
        \App\Reviewer::whereId($request->reviewerId)
            ->decrement('point', $request->amount);
        //포인트출금내역기록
        \App\Point::create([
            'reviewer_id'=>$request->reviewerId,
            'kinds'=>'w',
            'amount'=>$request->amount,
        ]);
        $apply_deposits = \App\Deposit::where('complete',false)->with('reviewer:id,name,mobile_num')->with('bank')->get();

        return \Response::json([
            'finhtml' => \View::make('admin.part_apply_deposit', array('apply_deposits' => $apply_deposits))->render(),
            ]);
    }
    //관리자-포인트 출금완료내역
    public function complete_deposits()
    {
        $complete_deposits = \App\Deposit::where('complete',true)->with('reviewer:id,name,mobile_num')->with('bank')->get();
        return view('admin.complete_deposits',[
            'complete_deposits' => $complete_deposits,
        ]);
    }
    
    //****자주묻는질문
    //리뷰어FAQ 카테고리 보기
    public function rFAQCategory()
    {
        $rFAQCategories = ReviewerFaqCate::get();
        return view('admin.rFAQCategory',[
            'rFAQCategories' => $rFAQCategories,
        ]);
    }
    //리뷰어FAQ 카테고리 만들기
    public function saverFAQCategory(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
        ]);
        $newrFAQCategory = ReviewerFaqCate::create($request->only('name'));

        if(! $newrFAQCategory){
            return back()->withInput();
        }
        $rFAQCategories = ReviewerFaqCate::get();
        return \Response::json([
            'finhtml' => \View::make('admin.part_rFAQCategory', array('rFAQCategories' => $rFAQCategories))->render(),
            ]);
    }
    //리뷰어FAQ 카테고리 삭제
    public function delrFAQCategory($id)
    {
        ReviewerFaqCate::find($id)->delete($id);
        $rFAQCategories = ReviewerFaqCate::get();
        return \Response::json([
            'finhtml' => \View::make('admin.part_rFAQCategory', array('rFAQCategories' => $rFAQCategories))->render(),
            ]);
    }
    //광고주FAQ 카테고리 보기
    public function aFAQCategory()
    {
        $aFAQCategories = AdvertiserFaqCate::get();
        return view('admin.aFAQCategory',[
            'rFAQCategories' => $aFAQCategories,
        ]);
    }
    //광고주FAQ 카테고리 만들기
    public function saveaFAQCategory(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
        ]);
        $newaFAQCategory = AdvertiserFaqCate::create($request->only('name'));

        if(! $newaFAQCategory){
            return back()->withInput();
        }
        
        $aFAQCategories = AdvertiserFaqCate::get();
        return \Response::json([
            'finhtml' => \View::make('admin.part_rFAQCategory', array('rFAQCategories' => $aFAQCategories))->render(),
            ]);
    }
    //광고주FAQ 카테고리 삭제
    public function delaFAQCategory($id)
    {
        AdvertiserFaqCate::find($id)->delete($id);
        $aFAQCategories = AdvertiserFaqCate::get();
        return \Response::json([
            'finhtml' => \View::make('admin.part_rFAQCategory', array('rFAQCategories' => $aFAQCategories))->render(),
            ]);
    }

}