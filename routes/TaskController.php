<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Linkhub\LinkhubException;
use Linkhub\Popbill\JoinForm;
use Linkhub\Popbill\CorpInfo;
use Linkhub\Popbill\ContactInfo;
use Linkhub\Popbill\ChargeInfo;
use Linkhub\Popbill\PopbillException;

use Linkhub\Popbill\PopbillMessaging;
use Linkhub\Popbill\ENumMessageType;

class TaskController extends Controller
{
    public function __construct() {

    // 통신방식 설정
    define('LINKHUB_COMM_MODE', config('popbill.LINKHUB_COMM_MODE'));

    // 문자 서비스 클래스 초기화
    $this->PopbillMessaging = new PopbillMessaging(config('popbill.LinkID'), config('popbill.SecretKey'));

    // 연동환경 설정값, 개발용(true), 상업용(false)
    $this->PopbillMessaging->IsTest(config('popbill.IsTest'));
  }
    //단문전송
    public function SendSMS(String $tel, String $name){

  }
    /**
   * LMS(장문)를 전송합니다.
   * - 메시지 내용이 2,000Byte 초과시 메시지 내용은 자동으로 제거됩니다.
   * - https://docs.popbill.com/message/phplaravel/api#SendLMS
   */
  public function SendLMS(String $tel, String $name, String $cam_link, String $end_submit, String $cam_name){

    // 팝빌 회원 사업자번호, "-"제외 10자리
    $testCorpNum = '3816900094';

    // 예약전송일시(yyyyMMddHHmmss), null인경우 즉시전송
    $reserveDT = null;

    // 광고문자 전송여부
    $adsYN = false;

    // 전송요청번호
    // 파트너가 전송 건에 대해 관리번호를 구성하여 관리하는 경우 사용.
    // 1~36자리로 구성. 영문, 숫자, 하이픈(-), 언더바(_)를 조합하여 팝빌 회원별로 중복되지 않도록 할당.
    $requestNum = time().'_'.rand(100, 999);

    $Messages[] = array(
        'snd' => '07043482627',		// 발신번호, 팝빌에 등록되지 않은 발신번호 기재시 오류처리
        'sndnm' => '리뷰의힘',			// 발신자명
        'rcv' => $tel,			// 수신번호
        'rcvnm' => $name,		  // 수신자 성명
        'msg'	=> '[리뷰의힘]  '.$cam_name.' 리뷰어로 선정되었습니다. 리뷰제출 마감일은 '.$end_submit.'입니다. 선정캠페인링크:'.$cam_link,
        // 개별 메시지 내용. 장문은 2000byte로 길이가 조정되어 전송됨.
        'sjt'	=> '[리뷰의힘]리뷰어선정알림'	 // 개별 메시지 내용
    );

    try {
        $receiptNum = $this->PopbillMessaging->SendLMS($testCorpNum, '', '', '', $Messages, $reserveDT, $adsYN, '', '', '', $requestNum);
    }
    catch (PopbillException | LinkhubException $pe) {
        $code = $pe->getCode();
        $message = $pe->getMessage();
        return '응답코드 : '.$code.PHP_EOL.'응답메시지 : '.$message;
    }
    return '문자전송 접수번호 : '.$receiptNum;
  }

    
}
