<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\QCategory;
use App\Onetoone;
use App\ReviewerFaqCate;
use App\AdvertiserFaqCate;

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
        $reviewers = \App\Reviewer::with('plan:id,reviewer_id')->simplePaginate(30);
        return view('admin.reviewer',[
            'reviewers'=>$reviewers,
        ]);
   }
    //리뷰전략보기
    public static function plan($id){
        $plan = \App\Plan::whereId($id)->first();
         return \Response::json([
            'showhtml' => \View::make('admin.part_plan', array('plan' => $plan))->render(),
            ]);
   }
    //광고주목록보기
    public static function advertisers(){
        $advertisers = \App\Advertiser::simplePaginate(30);
        return view('admin.advertisers',[
            'advertisers'=>$advertisers,
        ]);
   }
    
    //캠페인검수대기목록
     public function waitConfirmCam()
    {   
         $waitCampaigns = \App\Campaign::where('confirm',0)->with('brand')->get();
        return view('admin.waitcam',[
            'waitCampaigns' => $waitCampaigns,
        ]);
    }
    //캠페인승인
    public static function confirmCampaign(Request $request){
      \App\Campaign::where('id', $request->nowId)->update(['confirm' => 1]);
        return;
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
        $newqcategory = QCategory::create($request->only('name'));

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
        $onetoone->update($request->all());
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
        $onetoone->update($request->all());
        $onetoones = Onetoone::where('answer','!=',null)->select('id','title','qcategory_id','reviewer_id','advertiser_id','created_at')
            ->with('qcategory','reviewer','advertiser')->get();
         return \Response::json([
            'finhtml' => \View::make('admin.part_list_answer2', array('onetoones' => $onetoones))->render(),
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