<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class PasswordsController extends Controller
{
    /**
     * Create new password controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRemind()
    {
        return view('remind');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param \Illuminate\Http\Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    
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
        $cert_mobile_num = $certification->phone;
            return response()->json(['cert_mobile_num'=>$cert_mobile_num]);
	}
        }else {
            return response()->json(['name'=>'error']);
        }
        
    }
    
    
    public function postRemind(Request $request)
    {
        $email = $request->get('email');
        $mobile_num = $request->get('cert_mobile_num');
        
        if(App\Reviewer::where('email', $email)->where('mobile_num', $mobile_num)->first()){
            $who='Reviewer';
        } elseif(App\Advertiser::where('email', $email)->where('mobile_num', $mobile_num)->first()){
            $who='Advertiser';
        } else {
            flash('일치하는 회원이 없습니다.')->warning();
            return back()->withInput();
        }
        return redirect(route('reset.create'))->with([
            'email'=>$email,
            'who'=>$who,
        ]);
    }

    /**
     * Display the password reset view for the given token.
     *
     * @param string|null $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getReset()
    {
        return view('pwreset', [
            'email'=>session()->get('email'),
            'who'=>session()->get('who'), 
        ]);
    }

    /**
     * Reset the given user's password.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postReset(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed|min:8|regex:/^.*(?=.{2,})(?=.*[a-zA-Z])(?=.*[0-9]).*$/',
        ]);
        $who='App\\'.$request->input('who');
        
        $who::whereEmail($request->input('email'))->first()->update([
            'password' => bcrypt($request->input('password'))
        ]);

        return view('pwresetdone');
    }

    /**
     * Make an error response.
     *
     * @param     $message
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function respondError($message)
    {
        flash()->error($message);

        return back()->withInput(\Request::only('email'));
    }

    /**
     * Make a success response.
     *
     * @param $message
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function respondSuccess($message)
    {
        flash($message);

        return redirect('/');
    }
}
