@extends('layouts.main')
@section('content')

<form action="{{ route('advertisers.store') }}" method="post" class="form__auth">
{!! csrf_field() !!}
    <div class="sub-container bt-ddd bg-smile m-top-bar">
		<!-- 상세 컨텐츠내용 1 -->	
		<div class="content-in-sub member" id="content_1">
			<ul class="member-tab">
				<li class="on"><b>01</b> 광고주 이용약관 동의</li>
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
				<li><b>01</b> 광고주 이용약관 동의</li>
				<li class="on"><b>02</b> 기본정보 입력</li>
			</ul>
		
			<!-- 필수정보입력 -->
			<div class="join-agreement">
				<h3>필수정보입력</h3>
				<table class="table_form" summary="이 테이블은 필수정보입력으로 구성되어 있습니다.">
					<caption>상세정보 입력</caption>
					<tbody style="width:100%; display:table;">
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
							<td class="{{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
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
							<th>휴대폰번호</th>
							<td class="{{ $errors->has('mobile_num') ? 'has-error' : '' }}">
                <input type="tel" name="mobile_num" placeholder="'-'없이 숫자만 입력해주세요!" value="{{old('mobile_num')}}" class="w150"><button type="button" name="button" class="btn btn-check">인증번호 발송</button>
                {!! $errors->first('mobile_num','<span class="red">:message</span>')!!}</td>					
						</tr>
                        
                        
                        <tr>	
							<th>브랜드명</th>
							<td class="{{ $errors->has('brand_name') ? 'has-error' : '' }}">
                <input type="text" name="brand_name" placeholder="브랜드명" value="{{old('brand_name')}}">
                {!! $errors->first('brand_name','<span class="red">:message</span>')!!}</td>							
						</tr>

                        <tr>	
							<th>브랜드카테고리</th>
							<td class="{{ $errors->has('category_id') ? 'has-error' : '' }}">
                            <select name="category_id">
                                @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('category_id','<span>:message</span>')!!}</td>							
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