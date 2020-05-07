<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdvertisersController extends Controller
{
   protected $guard = 'advertiser';
    
    public function __construct(){
        $this->middleware('guest');
    }
    public function create(){
        
        $categories = \App\Category::get();
        return view('advertisers.create', compact('categories'));
    }
    
    public function store(Request $request){
        $this->validate($request,[
            'email' => 'required|email|max:255|unique:advertisers',
            'name' => 'required|max:30',
            'password' => 'required|confirmed|min:6',
            'mobile_num' => 'required|digits:11|unique:advertisers',
            'category_id' => 'required',
            'brand_name' => 'required|max:210'
        ]);
        
        $advertiser = \App\Advertiser::create([
            'email'=>$request->input('email'),
            'name'=>$request->input('name'),
            'password'=>bcrypt($request->input('password')),
            'mobile_num'=>$request->input('mobile_num'),
            'receive_agreement'=>$request->input('receive_agreement'),
            'certification_key'=>$request->input('certification_key')
        ]);
        
        $brand = \App\Brand::create([
            'name'=>$request->input('brand_name'),
            'category_id'=>$request->input('category_id'),
            'advertiser_id'=>$advertiser->id,
        ]);
        auth()->guard('advertiser')->login($advertiser);

        return view('advertisers.registerok',['name'=>auth()->guard('advertiser')->user()->name]);
    }
    
    public function certification(Request $request){
        include(app_path() . '/Http/Controllers/iamport.php');
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
        $isExists = \App\Advertiser::where('certification_key',$unique_key)->first();
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
    //광고주수정
    public function edit(\App\Advertiser $advertiser)
    {
         return \Response::json([
            'showhtml' => \View::make('admin.part_edit_advertiser', array('advertiser' => $advertiser))->render(),
            ]);
    }
    //광고주수정입력
    public function update(Request $request, \App\Advertiser $advertiser)
    {
        $advertiser->update($request->all());
        return redirect(route('admin.advertisers'));
    }
    
    //광고주 삭제
    public function destroy(\App\Advertiser $advertiser)
    {
        $advertiser->delete();
        return response()->json([], 204);
    }
    
}
