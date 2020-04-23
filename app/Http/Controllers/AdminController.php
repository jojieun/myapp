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
use App\ModifyCampaign;
use Image;
use App\Exports\ReviewerExport;
use App\Exports\AdvertiserExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

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
    //관리자 리뷰어 목록 다운로드
    public static function down_reviewer(){
        return Excel::download(new ReviewerExport, date('YndHis').'rivewers.xlsx');
   }
    //광고주목록보기
    public static function advertisers(){
        $advertisers = \App\Advertiser::simplePaginate(30);
        return view('admin.advertisers',[
            'advertisers'=>$advertisers,
        ]);
   }
    //관리자 광고주 목록 다운로드
    public static function down_advertiser(){
        return Excel::download(new AdvertiserExport, date('YndHis').'advertisers.xlsx');
   }
    
    //**********캠페인
    //캠페인검수대기목록
     public function waitConfirmCam()
    {   
         $waitCampaigns = \App\Campaign::where('confirm',0)->where('check_payment',1)->select('id','brand_id','created_at','name')->with('brand')->get();
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
        $waitCampaigns = \App\Campaign::where('confirm',0)->where('check_payment',1)->select('id','brand_id','created_at','name')->with('brand')->get();
        return \Response::json([
            'finhtml' => \View::make('admin.part_waitcam', array('waitCampaigns' => $waitCampaigns))->render(),
            ]);
   }
    //수정요청 캠페인
    public function modify_campaign()
    {
        $modify_campaigns = ModifyCampaign::where('confirm','w')->select('id','campaign_id','brand_id','created_at','name')->with('brand')->get();
        return view('admin.modify_campaign',[
            'modify_campaigns' => $modify_campaigns,
        ]);
    }
    //수정요청캠페인자세히보기
    public static function show_modify(ModifyCampaign $modify_campaign, Campaign $campaign){
         return \Response::json([
            'showhtml' => \View::make('admin.part_show_modify', array('modify_campaign' => $modify_campaign, 'campaign' => $campaign))->render(),
            ]);
   }
    //수정요청 승인
    public static function confirmModify(Request $request){
        $nowId = $request->nowId;
        $nowResult = $request->c_result;
        
      ModifyCampaign::where('id', $nowId)->update(['confirm' => $nowResult]);
        if($nowResult=='a'){
            $modi=ModifyCampaign::whereId($nowId)->first();
            Campaign::whereId($modi->campaign_id)->update([
                'channel_id' => $modi->channel_id,
                'brand_id' => $modi->brand_id,
                'name' => $modi->name,
                'form' => $modi->form,
                'recruit_number' => $modi->recruit_number,
                'offer_point' => $modi->offer_point,
                'offer_goods' => $modi->offer_goods,
                'start_recruit' => $modi->start_recruit,
                'end_recruit' => $modi->end_recruit,
                'end_submit' => $modi->end_submit,
                'contact' => $modi->contact,
                'mission' => $modi->mission,
                'keyword' => $modi->keyword,
                'area_id' => $modi->area_id,
                'etc' => $modi->etc,
                'visit_time' => $modi->visit_time,
                'zipcode' => $modi->zipcode,
                'address' => $modi->address,
                'detail_address' => $modi->detail_address,
                'main_image' => $modi->main_image,
                'sub_image1' => $modi->sub_image1,
                'sub_image2' => $modi->sub_image2,
                'sub_image3' => $modi->sub_image3,
            ]);
        }
        $modify_campaigns = ModifyCampaign::where('confirm','w')->select('id','campaign_id','brand_id','created_at','name')->with('brand')->get();
        return \Response::json([
            'finhtml' => \View::make('admin.part_modify_campaign', array('modify_campaigns' => $modify_campaigns))->render(),
            ]);
   }
//리뷰어 모집중 캠페인
    public function recruit_cam()
    {
        $recruitCampaigns = Campaign::where('confirm',1)
            ->whereDate('end_recruit', '>=', Carbon::now()->toDateString())
            ->select('id','name','recruit_number','start_recruit','end_recruit','brand_id')
            ->with('brand')
            ->withCount('campaignReviewers')
            ->latest()
            ->get();
        return view('admin.recruit_cam',[
            'recruitCampaigns' => $recruitCampaigns,
        ]);
    }
    //리뷰어 모집중 캠페인 --신청 리뷰어 보기
    public function recruit_reviewer(int $camId)
    {
        $campaign_reviewers = \App\CampaignReviewer::where('campaign_id',$camId)->with('reviewer:id,email,name')->get();
        return \Response::json([
            'finhtml' => \View::make('admin.part_campaign_reviewers', array('campaign_reviewers' => $campaign_reviewers))->render(),
            ]);
    }
    // 리뷰 진행중 캠페인
    public function submit_cam()
    {
        $submit_cams = Campaign::where('confirm',1)
            ->whereDate('end_recruit', '<', Carbon::now()->subDay()->toDateString())
            ->whereDate('end_submit', '>=', Carbon::now()->toDateString())
            ->select('id','name','recruit_number','end_submit','brand_id')
            ->with('brand')
            ->withCount(['campaignReviewers' => function ($query) {
                $query->where('selected', 1);
            }])
            ->latest()
            ->get();
        return view('admin.submit_cams',[
            'submit_cams' => $submit_cams,
        ]);
    }
    //리뷰 진행중 캠페인 --선정 리뷰어 보기
    public function submit_reviewer(int $camId)
    {
        $campaign_reviewers = \App\CampaignReviewer::where('campaign_id',$camId)
            ->where('selected',1)
            ->with(['new_review','reviewer:id,email,name'])->get();
        return \Response::json([
            'finhtml' => \View::make('admin.part_submit_campaign_reviewers', array('campaign_reviewers' => $campaign_reviewers))->render(),
            ]);
    }
// 완료 캠페인
    public function end_cam()
    {
        $end_cams = Campaign::where('confirm',1)
            ->whereDate('end_submit', '<', Carbon::now()->toDateString())
            ->select('id','name','recruit_number','end_submit','brand_id')
            ->with('brand')
            ->withCount('reviews')
            ->withCount(['campaignReviewers' => function ($query) {
                $query->where('selected', 1);
            }])
            ->latest()
            ->get();
        return view('admin.end_cam',[
            'end_cams' => $end_cams,
        ]);
    }
    
    // 미제출 리뷰어(블랙리스트)
    public function black_list()
    {
        $black_lists = \App\CampaignReviewer::where('selected', 1)
            ->whereHas('campaign',function ($query) {
                $query->whereDate('end_submit', '<', Carbon::now()->toDateString());
            })
            ->doesntHave('new_review')
            ->with(['reviewer:id,name,email','campaign:id,name,end_submit'])
            ->latest()
            ->get();

        return view('admin.black_list',[
            'black_lists' => $black_lists,
        ]);
    }
    
    
    
    //*********** 캠페인 옵션
    //캠페인 노출옵션 구매내역
    public function exposure_purchase()
    {
        $exposure_purchases= CampaignExposure::with('campaign:id,name')->with('exposure:id,name')->latest()->get();
        return view('admin.exposure_purchase',[
            'exposure_purchases' => $exposure_purchases,
            'exposures'=>Exposure::select('id', 'name')->get()
        ]);
    }
    //캠페인 노출옵션 구매내역 수정
    public function exposure_purchase_update(Request $request, CampaignExposure $campaign_exposure)
    {
        $campaign_exposure->update(['exposure_id'=>$request->exposure_id]);
        return $this->exposure_purchase();
    }
    
    //캠페인 홍보옵션 구매내역
    public function promotion_purchase()
    {
        $promotion_purchases= CampaignPromotion::with('campaign:id,name')->with('promotion:id,name')->latest()->get();
        return view('admin.promotion_purchase',[
            'promotion_purchases' => $promotion_purchases,
        ]);
    }
    //캠페인 홍보옵션 구매내역 처리확인
    public function promotion_purchase_update(CampaignPromotion $campaign_promotion)
    {
        $campaign_promotion->update(['process'=>true]);
        return $this->promotion_purchase();
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
    
    //배너관리
    //메인배너관리
    public function main_banner_edit()
    {
        $main_banners = \App\MainBanner::get();
        return view('admin.main_banner_edit',[
            'banners' => $main_banners,
        ]);
    }
    //메인배너-수정
    public function main_banner_modi(Request $request, \App\MainBanner $main_banner)
    {
        $main_banner->url=$request->url;
        if($request->hasfile('name')){
            \File::delete('files/banner/'.$main_banner->name);
            $file = $request->file('name');
            $filename = time().filter_var($file->getClientOriginalName(),FILTER_SANITIZE_URL);
            $location = 'files/banner/'.$filename;
            $img = Image::make($file);
            $img->save($location);
            $main_banner->name = $filename;
        }
        $main_banner -> save();
        return redirect(route('admin.main_banner_edit'));
    }
    //메인배너-삭제
    public function main_banner_del(\App\MainBanner $main_banner)
    {
        \File::delete('files/banner/'.$main_banner->name);
        $main_banner->delete();
        return redirect(route('admin.main_banner_edit'));
    }
    //메인배너-추가
    public function main_banner_add(Request $request){
        
        $main_banner = new \App\MainBanner;
        $main_banner->url=$request->url;
        if($request->hasfile('name')){
            $file = $request->file('name');
            $filename = time().filter_var($file->getClientOriginalName(),FILTER_SANITIZE_URL);
            $location = 'files/banner/'.$filename;
            $img = Image::make($file);
            $img->save($location);
            $main_banner->name = $filename;
        }
        $main_banner -> save();
        return redirect(route('admin.main_banner_edit'));
    }
    //중단배너관리
    public function middle_banner_edit()
    {
        $middle_banners = \App\MiddleBanner::get();
        return view('admin.middle_banner_edit',[
            'banners' => $middle_banners,
        ]);
    }
    //중단배너-수정
    public function middle_banner_modi(Request $request, \App\MiddleBanner $middle_banner)
    {
        $middle_banner->url=$request->url;
        if($request->hasfile('name')){
            \File::delete('files/banner/'.$middle_banner->name);
            $file = $request->file('name');
            $filename = time().filter_var($file->getClientOriginalName(),FILTER_SANITIZE_URL);
            $location = 'files/banner/'.$filename;
            $img = Image::make($file);
            $img->save($location);
            $middle_banner->name = $filename;
        }
        $middle_banner -> save();
        return redirect(route('admin.middle_banner_edit'));
    }
    //중단배너-삭제
    public function middle_banner_del(\App\MiddleBanner $middle_banner)
    {
        \File::delete('files/banner/'.$middle_banner->name);
        $middle_banner->delete();
        return redirect(route('admin.middle_banner_edit'));
    }
    //중단배너-추가
    public function middle_banner_add(Request $request){
        
        $middle_banner = new \App\MiddleBanner;
        $middle_banner->url=$request->url;
        if($request->hasfile('name')){
            $file = $request->file('name');
            $filename = time().filter_var($file->getClientOriginalName(),FILTER_SANITIZE_URL);
            $location = 'files/banner/'.$filename;
            $img = Image::make($file);
            $img->save($location);
            $middle_banner->name = $filename;
        }
        $middle_banner -> save();
        return redirect(route('admin.middle_banner_edit'));
    }
    //하단배너관리
    public function bottom_banner_edit()
    {
        $bottom_banners = \App\BottomBanner::get();
        return view('admin.bottom_banner_edit',[
            'banners' => $bottom_banners,
        ]);
    }
    //하단배너-수정
    public function bottom_banner_modi(Request $request, \App\BottomBanner $bottom_banner)
    {
        $bottom_banner->url=$request->url;
        if($request->hasfile('name')){
            \File::delete('files/banner/'.$bottom_banner->name);
            $file = $request->file('name');
            $filename = time().filter_var($file->getClientOriginalName(),FILTER_SANITIZE_URL);
            $location = 'files/banner/'.$filename;
            $img = Image::make($file);
            $img->save($location);
            $bottom_banner->name = $filename;
        }
        $bottom_banner -> save();
        return redirect(route('admin.bottom_banner_edit'));
    }
    //하단배너-삭제
    public function bottom_banner_del(\App\BottomBanner $bottom_banner)
    {
        \File::delete('files/banner/'.$bottom_banner->name);
        $bottom_banner->delete();
        return redirect(route('admin.bottom_banner_edit'));
    }
    //하단배너-추가
    public function bottom_banner_add(Request $request){
        
        $bottom_banner = new \App\BottomBanner;
        $bottom_banner->url=$request->url;
        if($request->hasfile('name')){
            $file = $request->file('name');
            $filename = time().filter_var($file->getClientOriginalName(),FILTER_SANITIZE_URL);
            $location = 'files/banner/'.$filename;
            $img = Image::make($file);
            $img->save($location);
            $bottom_banner->name = $filename;
        }
        $bottom_banner -> save();
        return redirect(route('admin.bottom_banner_edit'));
    }

}