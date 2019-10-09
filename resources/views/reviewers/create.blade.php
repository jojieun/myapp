@extends('layouts.main')
@section('content')

<form action="{{ route('reviewers.store') }}" method="post" class="form__auth">
{!! csrf_field() !!}
    <div class="sub-container bt-ddd bg-smile m-top-bar">
		<!-- 상세 컨텐츠내용 1 -->	
		<div class="content-in-sub member" id="content_1">
			<ul class="member-tab">
				<li class="on"><b>01</b> 약관동의 및 SNS URL</li>
				<li><b>02</b> 기본정보 입력</li>
			</ul>

			<!-- 약관동의 -->
			<div class="join-agreement">				
				<p><span class="input-button"><input type="checkbox" id="checkAll" name=""><label for="checkAll">전체 동의하기</label></span></p>
				<ul>
					<li>
						<span class="input-button"><input type="checkbox" id="checkAgree1"  name="terms1" class="terms" @if(old('receive_agreement')!==null) checked @endif><label for="checkAgree1">
						<a href="#popup_term">서비스 이용약관동의</a><span class="red">[필수]</span></label></span>
                        <a href="#popup_term"><img src="/img/common/join_arrow.gif" alt="서비스 이용약관동의 내용보기"></a>
					</li>
					<li>
						<span class="input-button"><input type="checkbox" id="checkAgree2"  name="terms2" class="terms" @if(old('receive_agreement')!==null) checked @endif><label for="checkAgree2"><a href="#popup_term">개인정보 수집 및 이용동의</a> <span class="red">[필수]</span></label></span>
						<a href="#popup_term"><img src="/img/common/join_arrow.gif" alt="개인정보 수집 및 이용동의 내용보기"></a>
					</li>
					<li>
						<span class="input-button"><input type="checkbox" id="checkAgree3"  name="terms3" class="terms" @if(old('receive_agreement')!==null) checked @endif><label for="checkAgree3"><a href="#popup_term">개인정보 제 3자 제공동의</a> <span class="red">[필수]</span></label></span>
						<span class="txt">원활한 업무 진행을 위하여, 광고주에게 리뷰어분들의 일부 정보가 제공될 수 있습니다.</span>
						<a href="#popup_term"><img src="/img/common/join_arrow.gif" alt="개인정보 제 3자 제공동의 내용보기"></a>
					</li>
					<li>
						<span class="input-button">
                            <input type="hidden" value="0" name="receive_agreement" />
                            <input type="checkbox" id="checkAgree4"  name="receive_agreement" class="terms" value="1" @if(old('receive_agreement')==1) checked @endif><label for="checkAgree4"><a href="#popup_term">마케팅 정보 메일 및 SMS 수신 동의 </a><span class="c-999">[선택]</span></label></span>
						<a href="#popup_term"><img src="/img/common/join_arrow.gif" alt="마케팅 정보 메일 및 SMS 수신 동의 내용보기"></a>
					</li>
				</ul>
			</div>
			<!-- //약관동의 -->
			
			<!-- sns url -->
			<div class="join-snsurl">
				<h3>SNS URL<p class="fl-r mt5 table_add_txt2">SNS 주소를 입력하지 않아도 가입이 가능합니다.</p></h3>
				<ul>
					<li>
						<span><em>https://</em>blog.naver.com/</span>
						<input type="text" placeholder="네이버블로그" name="naver_blog" value="{{ old('naver_blog') }}">
					</li>
					<li>
						<span><em>https://</em>post.naver.com/</span>
						<input type="text" placeholder="네이버포스트" name="naver_post" value="{{ old('naver_post') }}">
					</li>
					
					<li>
						<span><em>https://</em>www.facebook.com/</span>
						<input type="text" placeholder="페이스북" name="facebook" value="{{ old('facebook') }}">
					</li>
					
					<li>
						<span><em>https://</em>www.instagram.com/</span>
						<input type="text" placeholder="인스타그램" name="instagram" value="{{ old('instagram') }}">
					</li>
					
					<li>
						<span><em>https://</em>story.kakao.com/</span>
						<input type="text" placeholder="카카오스토리" name="kakao" value="{{ old('kakao') }}">
					</li>
					
					<li>
						<span><em>https://</em>www.youtube.com/channel/</span>
						<input type="text" placeholder="유튜브" name="youtube" value="{{ old('youtube') }}">
					</li>
				</ul>
			</div>
			<!-- //sns url -->			

			<div class="join_btn_wrap">				
				<a class="btn black" id="next_content">다음단계</a>
			</div>

            <!-- popup : 이용약관 -->
        <a href="#" class="overlay" id="popup_term"></a>
        <div class="popup term">
			<div class="text3">
				<ul id="popup_tab">
                    <li class="select">서비스 이용약관동의</li>
                    <li>개인정보 수집 및 이용동의</li>
                    <li>개인정보 제 3자 제공동의</li>
                    <li>마케팅 정보 메일 및 SNS 수신 동의</li>
                </ul>
				
				<!-- 개인정보 제 3자 제공안내 -->
				<div class="termsTerm">
					<div class="terms">
						<p>서비스 이용약관동의</p>
					</div>
<!--            서비스 이용약관동의-->
                    <div class="terms">
						<p>개인정보 수집 및 이용동의</p>
					</div>
<!--            개인정보 수집 및 이용동의-->
                    <div class="terms">
						<p>개인정보 제 3자 제공동의</p>
					</div>
<!--            개인정보 제 3자 제공동의-->
                    <div class="terms">
						<p>마케팅 정보 메일 및 SNS 수신 동의</p>
					</div>
<!--            마케팅 정보 메일 및 SNS 수신 동의-->
				</div>
				<!-- //개인정보 제 3자 제공안내 -->

				<a class="btn black h46" href="#close" id="checkAll2">전체 약관 동의</a>
			</div>
            <a class="close" href="#"></a>
        </div>
		<!-- //popup : 이용약관 --> 
            
            
            <!-- popup : 필수약관 동의 필요 -->
        <a href="#" class="overlay" id="popup_requir"></a>
        <div class="popup">
			<div class="text">
				<p>필수약관에 동의해주세요!</p>
				<a class="btn black h46 w125" href="#close">닫기</a>
			</div>
            <a class="close" href="#close"></a>
        </div>
<!--             //popup : 필수약관 동의 필요-->
            
		</div>
		<!-- //상세 컨텐츠내용 1 -->
        
        		<!-- 상세 컨텐츠내용 2 -->	
		<div class="content-in-sub member" id="content_2">
			<ul class="member-tab">
				<li><b>01</b> 약관동의 및 SNS URL</li>
				<li class="on"><b>02</b> 기본정보 입력</li>
			</ul>
		
			<!-- 필수정보입력 -->
			<div class="join-agreement">
				<h3>필수정보입력</h3>
				<table class="table_form" summary="이 테이블은 필수정보입력으로 구성되어 있습니다.">
					<caption>상세정보 입력</caption>
					<tbody>
						<tr>
							<th>이메일</th>
							<td class="{{ $errors->has('email') ? 'has-error' : '' }}">
                <input type="email" name="email" placeholder="이메일" value="{{old('email')}}">
                {!! $errors->first('email','<span class="red">:message</span>')!!}</td>								
						</tr>
						<tr>
							<th>비밀번호</th>
							<td class="{{ $errors->has('password') ? 'has-error' : '' }}">
                <input type="password" name="password" placeholder="비밀번호(영문과 숫자를 혼합해서 8자 이상)" />
                            {!! $errors->first('password','<span class="red">:message</span>')!!}
                            </td>								
						</tr>
						<tr>	
							<th>비밀번호 확인</th>
							<td class="{{ $errors->has('password') ? 'has-error' : '' }}">
                <input type="password" name="password_confirmation" placeholder="비밀번호 확인" />
                            {!! $errors->first('password_confirmation','<span class="red">:message</span>')!!}</td>							
						</tr>
						<tr>	
							<th>이름</th>
							<td class="{{ $errors->has('email') ? 'has-error' : '' }}">
                <input type="text" name="name" placeholder="이름" value="{{old('name')}}">
                {!! $errors->first('name','<span class="red">:message</span>')!!}</td>							
						</tr>
						<tr>	
							<th>닉네임</th>
							<td class="{{ $errors->has('nickname') ? 'has-error' : '' }}">
                <input type="text" name="nickname" placeholder="닉네임" value="{{old('nickname')}}">
                {!! $errors->first('nickname','<span class="red">:message</span>')!!}</td>							
						</tr>
						<tr>	
							<th>생년월일</th>
							<td class="{{ $errors->has('birth') ? 'has-error' : '' }}">
                <input type="date" name="birth" placeholder="생년월일" value="{{old('birth')}}">
                {!! $errors->first('birth','<span class="red">:message</span>')!!}</td>							
						</tr>
						<tr>
							<th>휴대폰번호</th>
							<td class="{{ $errors->has('mobile_num') ? 'has-error' : '' }}">
                <input type="tel" name="mobile_num" placeholder="'-'없이 숫자만 입력해주세요!" value="{{old('mobile_num')}}" class="w150"><button type="button" name="button" class="btn btn-check">인증번호 발송</button>
                {!! $errors->first('mobile_num','<span class="red">:message</span>')!!}</td>					
						</tr>
						<tr>						
							<th>주소</th>
							<td>
								<span class="mb10 {{ $errors->has('zipcode') ? 'has-error' : '' }}">
                <input type="text" name="zipcode" placeholder="우편번호" value="{{old('zipcode')}}" id="sample6_postcode" class="w150"/><button type="button" name="button" class="btn btn-check"  onclick="sample6_execDaumPostcode()">우편번호 찾기</button>{!! $errors->first('zipcode','<span class="red">:message</span>')!!}</span>
								<span class="mb10 {{ $errors->has('address') ? 'has-error' : '' }}">
                <input type="text" name="address" placeholder="주소" value="{{old('address')}}" id="sample6_address">
                {!! $errors->first('address','<span class="red">:message</span>')!!}</span>
								<span class="mb10 {{ $errors->has('detail_address') ? 'has-error' : '' }}">
                <input type="text" name="detail_address" id="sample6_detailAddress" placeholder="상세주소" value="{{old('detail_address')}}">
                {!! $errors->first('detail_address','<span class="red">:message</span>')!!}</span>							
							</td>			
						</tr>
						<tr>
							<th>성별</th>
							<td class="mt10">
								<span class="input-button"><input type="radio" name="gender" value="f" @if(old('gender')=='f') checked @endif id="female"><label for="female">여자</label></span>
								<span class="input-button"><input type="radio" name="gender" value="m" @if(old('gender')=='m') checked @endif id="male"><label for="male">남자</label></span>
                                {!! $errors->first('gender','<span class="red">:message</span>')!!}</span>
							</td>		
						</tr>
					</tbody>
				</table>
			</div>
			<!-- //필수정보입력 -->
			
			<div class="join_btn_wrap">
				<button type="button" id="prev_content" name="" class="btn">이전단계</button>
				<button type="submit" id="" name="" class="btn black">가입완료</button>
			</div>			
		</div>
		<!-- //상세 컨텐츠내용 2 -->	
         
	</div>
<!--    .sub-container-->
</form>
<script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script>
    //본 예제에서는 도로명 주소 표기 방식에 대한 법령에 따라, 내려오는 데이터를 조합하여 올바른 주소를 구성하는 방법을 설명합니다.
    function sample6_execDaumPostcode() {
        new daum.Postcode({
            oncomplete: function(data) {
                // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var addr = ''; // 주소 변수

                //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                    addr = data.roadAddress;
                } else { // 사용자가 지번 주소를 선택했을 경우(J)
                    addr = data.jibunAddress;
                }

                // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
                if(data.userSelectedType === 'R'){
                    // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                    // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                    if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                        extraAddr += data.bname;
                    }
                    // 건물명이 있고, 공동주택일 경우 추가한다.
                    if(data.buildingName !== '' && data.apartment === 'Y'){
                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }

                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.getElementById('sample6_postcode').value = data.zonecode;
                document.getElementById("sample6_address").value = addr;
                // 커서를 상세주소 필드로 이동한다.
                document.getElementById("sample6_detailAddress").focus();
            }
        }).open();
    }
</script>
<script>
$(function(){
    checkcheck();
    var nextclick = 0;
    $('#next_content').click(function(){
        nextclick = 1;
        checkcheck();
    });
    $('#prev_content').click(function(){
        $('#content_2').css({
                height:0,
                margin:0
            });
            $('#content_1').removeAttr('style');
    });
    function checkcheck(){
        if($('#checkAgree1').is(":checked")&&$('#checkAgree2').is(":checked")&&$('#checkAgree3').is(":checked")){
            $('#content_1').css({
                height:0,
                margin:0
            });
            $('#content_2').removeAttr('style');
        }else{
            if(nextclick){
            window.location.hash = "#popup_requir";
                }
            $('#content_2').css({
                height:0,
                margin:0
            });
            $('#content_1').removeAttr('style');
        }
    }
    
	$( "#checkAll" ).click(function() {
		if($(this).is(":checked")){
				$(".terms").prop('checked', true);
		} else{
            $(".terms").prop('checked', false);
        }
    });
    $( "#checkAll2" ).click(function() {
        $( "#checkAll" ).prop('checked', true);
        $(".terms").prop('checked', true);
    });
    $('.termsTerm .terms').hide().eq(0).show();
    $('.join-agreement li').each(function(index, item){
        $(item).attr({'data-i':index})
    });
    $('#popup_tab li').each(function(index, item){
        $(item).attr({'data-i':index})
    });
    $('.join-agreement li, #popup_tab li').click(function(){
       var now = $(this).attr('data-i');
        $('#popup_tab li').removeClass().eq(now).addClass('select');
        $('.termsTerm .terms').hide().eq(now).show();
    });
    
});
</script>


@endsection