<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewersController extends Controller
{
    public function __construct(){
        $this->middleware('guest');
    }
    public function create(){
        return view('reviewers.create');
    }
    
    public function tempcreate(){
        return view('reviewers.temp_create');
    }
    
    public function store(Request $request){
        $this->validate($request,[
            'email' => 'required|email|max:255|unique:reviewers',
            'name' => 'required|max:30',
            'password' => 'required|confirmed|min:8|regex:/^.*(?=.{2,})(?=.*[a-zA-Z])(?=.*[0-9]).*$/',
            'nickname' => 'required|max:30|unique:reviewers',
            'mobile_num' => 'required|digits:11|unique:reviewers',
            'birth'=>'required|date',
            'zipcode'=>'required|digits:5',
            'address'=>'required',
            'gender'=>'required'
        ]);
        $reviewer = \App\Reviewer::create([
            'email'=>$request->input('email'),
            'name'=>$request->input('name'),
            'password'=>bcrypt($request->input('password')),
            'nickname'=>$request->input('nickname'),
            'mobile_num'=>$request->input('mobile_num'),
            'birth'=>$request->input('birth'),
            'zipcode'=>$request->input('zipcode'),
            'address'=>$request->input('address'),
            'detail_address'=>$request->input('detail_address'),
            'receive_agreement'=>$request->input('receive_agreement'),
            'gender'=>$request->input('gender'),
            'certification_key'=>$request->input('certification_key')
        ]);
        //sns 채널들
        $chls = [
            1=>'naver_blog',
            2=>'instagram',
            3=>'facebook',
            4=>'youtube',
            5=>'kakao',
            6=>'naver_post',
        ];
        foreach($chls as $key=>$chl){
            if($request->input($chl)){
                \App\ChannelReviewer::create([
                   'channel_id'=>$key,
                    'reviewer_id'=>$reviewer->id,
                    'name'=>$request->input($chl),
                ]);
            }
        }
        auth()->login($reviewer);
        return view('reviewers.registerok',['name'=>auth()->user()->name]);
    }
    
    //소셜가입
    public function social_store(Request $request){
        $this->validate($request,[
            'email' => 'required|email|max:255|unique:reviewers',
            'name' => 'required|max:30',
            'nickname' => 'required|max:30|unique:reviewers',
            'mobile_num' => 'required|digits:11|unique:reviewers',
            'birth'=>'required|date',
            'zipcode'=>'required|digits:5',
            'address'=>'required',
            'gender'=>'required'
        ]);
        $reviewer = \App\Reviewer::create([
            'email'=>$request->input('email'),
            'name'=>$request->input('name'),
            'nickname'=>$request->input('nickname'),
            'mobile_num'=>$request->input('mobile_num'),
            'birth'=>$request->input('birth'),
            'zipcode'=>$request->input('zipcode'),
            'address'=>$request->input('address'),
            'detail_address'=>$request->input('detail_address'),
            'receive_agreement'=>$request->input('receive_agreement'),
            'gender'=>$request->input('gender'),
        ]);
        //sns 채널들
        $chls = [
            1=>'naver_blog',
            2=>'instagram',
            3=>'facebook',
            4=>'youtube',
            5=>'kakao',
            6=>'naver_post',
        ];
        foreach($chls as $key=>$chl){
            if($request->input($chl)){
                \App\ChannelReviewer::create([
                   'channel_id'=>$key,
                    'reviewer_id'=>$reviewer->id,
                    'name'=>$request->input($chl),
                ]);
            }
        }
        auth()->login($reviewer);
        return view('reviewers.registerok',['name'=>auth()->user()->name]);
    }
    
    public function tempstore(Request $request){
        
        $this->validate($request,[
            'email' => 'required|email|max:255|unique:reviewers',
            'name' => 'required|max:30',
            'password' => 'required|confirmed|min:8|regex:/^.*(?=.{2,})(?=.*[a-zA-Z])(?=.*[0-9]).*$/',
            'nickname' => 'required|max:30|unique:reviewers',
            'mobile_num' => 'required|digits:11|unique:reviewers',
            'birth'=>'required|date',
            'zipcode'=>'required|digits:5',
            'address'=>'required',
            'gender'=>'required'
        ]);
        
        $reviewer = \App\Reviewer::create([
            'email'=>$request->input('email'),
            'name'=>$request->input('name'),
            'password'=>bcrypt($request->input('password')),
            'nickname'=>$request->input('nickname'),
            'mobile_num'=>$request->input('mobile_num'),
            'birth'=>$request->input('birth'),
            'zipcode'=>$request->input('zipcode'),
            'address'=>$request->input('address'),
            'detail_address'=>$request->input('detail_address'),
            'gender'=>$request->input('gender'),
            'receive_agreement'=>$request->input('receive_agreement'),
            'gender'=>$request->input('gender'),
            
        ]);
        //sns 채널들
        $chls = [
            1=>'naver_blog',
            2=>'instagram',
            3=>'facebook',
            4=>'youtube',
            5=>'kakao',
            6=>'naver_post',
        ];
        foreach($chls as $key=>$chl){
            if($request->input($chl)){
                \App\ChannelReviewer::create([
                   'channel_id'=>$key,
                    'reviewer_id'=>$reviewer->id,
                    'name'=>$request->input($chl),
                ]);
            }
        }
        auth()->login($reviewer);
        return view('reviewers.temp_registerok',['name'=>auth()->user()->name]);
    }
    
    public function certification(Request $request){
        include(app_path() . '\Http\Controllers\iamport.php');
        date_default_timezone_set('Asia/Seoul');
        $iamport = new Iamport('7637754882413623', 'jcpbcXwUyUEht95jovvJbI44Vw0IuvvNIVYUSuPqptITDOc1kILvqPzmmA5Q6AEOwDJo8zPx3xqGlDIF');
        #1. imp_uid 로 주문정보 찾기(아임포트에서 생성된 거래고유번호)
$result = $iamport->findCertificationByImpUID($request->imp_uid); //IamportResult 를 반환(success, data, error)
        if ( $result->success ) {
	/**
	*	IamportPayment 를 가리킵니다. __get을 통해 API의 Payment Model의 값들을 모두 property처럼 접근할 수 있습니다.
	*	참고 : https://api.iamport.kr/#!/payments/getPaymentByImpUid 의 Response Model
	*/
	$certification = $result->data;

	# certified 필드를 통해 인증여부를 판단합니다.
	if ( $certification->certified ) {
        $unique_key = $certification->unique_key;
        $isExists = \App\Reviewer::where('certification_key',$unique_key)->first();
        if($isExists){
        return response()->json(['name'=>'exists']);
    }else{
        return response()->json(['name'=>$certification->name,
                                'certification_key'=>$unique_key]);
    } 
	}
        } else {
            return response()->json(['name'=>'error']);
        }
        
    }
    //리뷰어수정
    public function edit(\App\Reviewer $reviewer)
    {
         return \Response::json([
            'showhtml' => \View::make('admin.part_edit_reviewer', array('reviewer' => $reviewer))->render(),
            ]);
    }
    //리뷰어수정입력
    public function update(Request $request, \App\Reviewer $reviewer)
    {
        $reviewer->update($request->all());
        return redirect(route('admin.reviewers'));
    }
    
    //리뷰어 삭제
    public function destroy(\App\Reviewer $reviewer)
    {
        $reviewer->delete();
        return response()->json([], 204);
    }
}
