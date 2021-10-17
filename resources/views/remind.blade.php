@extends('layouts.main')

@section('content')
<div class="sub-container bt-ddd bg-smile m-top-bar">
		<!-- 상세 컨텐츠내용 -->	
		<div class="content-in-sub member">
			<h2 class="m-text-left">
				<b>비밀번호 재설정</b>
				<p>새 비밀번호를 입력해주세요</p>
			</h2>
			<div class="login-wrap">
				<p class="h4"><span>비밀번호 재설정</span></p>
				<form method="post" action="{{ route('remind.store') }}" role="form" class="form__auth" id="pw_reset">
                    {!! csrf_field() !!}
                    @include('flash::message')
					<div class="login-group">
						<p class="form-group">
							<label for="">이메일</label>
							<input type="email" name="email" id="" class="full_width" value="{{old('email')}}" placeholder="가입한 이메일을 입력하세요.">
                            {!! $errors->first('email','<span class="red">:message</span>')!!}	
						</p>
						<p class="{{ $errors->has('mobile_num') ? 'has-error' : '' }}">
                            <label for="">휴대폰 번호</label>
                <input type="tel" name="mobile_num" placeholder="가입한 휴대폰번호를 '-'없이 숫자만 입력해주세요!" value="{{old('mobile_num')}}" class="w200" maxlength="20"><button type="button" name="button" class="btn btn-check w200" id="call_cert">인증번호 발송</button>
                {!! $errors->first('mobile_num','<span class="red">:message</span>')!!}
						</p>
                        <p class="cert hide">인증되었습니다.</p>
						<div class="login-group">
                            <input type="hidden" name="cert_mobile_num" value="">
							<button type="button" class="btn w50" onclick="window.history.back();">취소</button>
							<button type="submit" class="btn black w50 fl-r">비밀번호 재설정</button>
						</div>
					</div>
				</form>
			</div>

		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>
<!-- iamport.payment.js -->
  <script type="text/javascript" src="https://cdn.iamport.kr/js/iamport.payment-1.1.5.js"></script>
<script>
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
       } 
    });
    var IMP = window.IMP; // 생략해도 괜찮습니다.
    IMP.init("imp81498957"); // "imp00000000" 대신 발급받은 "가맹점 식별코드"를 사용합니다.
    //sms 인증함수
    function certification(){
        IMP.certification({
            merchant_uid : 'merchant_' + new Date().getTime(), //본인인증과 연관된 가맹점 내부 주문번호가 있다면 넘겨주세요
            phone:$('input[name=mobile_num]').val()
        }, function(rsp) {
            if ( rsp.success ) {
    	 // 인증성공
//        console.log(rsp.imp_uid);
//        console.log(rsp.merchant_uid);
                $.ajax({
				type : 'POST',
				url : "{{ route('remind.certification')}}",
				dataType : 'json',
				data : {
					imp_uid : rsp.imp_uid, "_token": "{{ csrf_token() }}"
				}
                }).done(function(rsp) {
		 		if(rsp.name=='error'){
                    alert('인증에 실패했습니다.');
                }else{
                    $('input[name=cert_mobile_num]').val(rsp.cert_mobile_num);
                    $('p.cert').removeClass('hide');
                }
		 });
        	
        } else {
    	 // 인증취소 또는 인증실패
        var msg = '인증에 실패하였습니다.';
        msg += '에러내용 : ' + rsp.error_msg;

        alert(msg);
        }
        });
    }//---sms 인증함수
    
    $('#call_cert').click(function(){
        if($('input[name=mobile_num]').val()){
            certification();
        } else {
            alert('휴대폰번호를 입력해주세요!');
        }
    });
    //비밀번호재설정 클릭
    $('#pw_reset').submit(function(){
        if($('input[name=cert_mobile_num]').val()){
            return true;
        } else {
            alert('휴대폰 인증을 진행해주세요!');
            return false;
        }
    });
</script>
@endsection