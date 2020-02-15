@extends('layouts.main')
@section('content')
			<!-- 왼쪽메뉴 -->
			@include('reviewers.reviewer_leftmenu')		
			<!-- 오른쪽 컨텐츠 -->
			<div class="right-content">
				<h2 class="mb70 m-text-left">회원정보수정</h2>		

				<form method="post" action="{{ route('reviewers.update_info', $user->id) }}">
                    {!! csrf_field() !!}
                    {!! method_field('PUT') !!}
				<!-- 기본정보 입력 -->
				<div class="table_form2">
					<dl>
						<dt>이메일</dt>
						<dd class="lh40">{{$user->email}}</dd>
					</dl>
					<dl>
						<dt>기존 비밀번호</dt>
                        <dd class="{{ $errors->has('origin_pw') ? 'has-error' : '' }}"><input name="origin_pw" type="password" id="" value="" class="full_width" placeholder="기존 비밀번호를 입력하세요" />{!! $errors->first('origin_pw','<span class="red">:message</span>')!!}</dd>
					</dl>
					<dl>
						<dt>새 비밀번호</dt>
						<dd><input name="password" type="password" id="" placeholder="비밀번호(영문과 숫자를 혼합해서 최소 8자이상)" class="full_width" />
                        {!! $errors->first('password','<span class="red">:message</span>')!!}</dd>
					</dl>
					<dl>
						<dt>비밀번호 확인</dt>
						<dd class="{{ $errors->has('password_confirmation') ? 'has-error' : '' }}"><input name="password_confirmation" type="password" id="" placeholder="비밀번호 확인" class="full_width" />
                        {!! $errors->first('password_confirmation','<span class="red">:message</span>')!!}</dd>
					</dl>
					<dl>
						<dt>이름</dt>
						<dd class="{{ $errors->has('name') ? 'has-error' : '' }}"><input name="name" type="text" id="" value="{{old('name', $user->name)}}" class="full_width" />
                        {!! $errors->first('name','<span class="red">:message</span>')!!}</dd>
					</dl>
					<dl>
						<dt>닉네임</dt>
                        <dd class="{{ $errors->has('nickname') ? 'has-error' : '' }}"><input name="nickname" type="text" id="" value="{{old('nickname', $user->nickname)}}" class="full_width" />
                        {!! $errors->first('nickname','<span class="red">:message</span>')!!}</dd>
					</dl>
                    <dl>
						<dt>생년월일</dt>
                        <dd class="{{ $errors->has('birth') ? 'has-error' : '' }}"><input name="birth" type="date" id="" value="{{old('birth', $user->birth)}}" class="full_width"/>
                        {!! $errors->first('birth','<span class="red">:message</span>')!!}</dd>
					</dl>
					<dl>
						<dt>휴대폰번호</dt>
						<dd class="{{ $errors->has('mobile_num') ? 'has-error' : '' }}"><input name="mobile_num" type="text" id="" value="{{old('mobile_num', $user->mobile_num)}}" class="w150"/><button type="button" name="button" class="btn btn-check">인증번호 발송</button>
                        {!! $errors->first('mobile_num','<span class="red">:message</span>')!!}</dd>
					</dl>
					<dl>						
						<dt>주소</dt>
						<dd>
							<span class="mb10 {{ $errors->has('zipcode') ? 'has-error' : '' }}"><input name="zipcode" type="text" value="{{old('zipcode', $user->zipcode)}}" id="sample6_postcode" placeholder="우편번호" class="w150 mb10"/><button type="button" name="button" class="btn btn-check"  onclick="sample6_execDaumPostcode()">우편번호 찾기</button>{!! $errors->first('zipcode','<span class="red">:message</span>')!!}</span>
							<span class="mb10 {{ $errors->has('address') ? 'has-error' : '' }}"><input name="address" type="text" id="sample6_address" placeholder="주소"  class="full_width mb10" value="{{old('address', $user->address)}}"/>{!! $errors->first('address','<span class="red">:message</span>')!!}</span>
							<span class="mb10 {{ $errors->has('detail_address') ? 'has-error' : '' }}"><input name="detail_address" type="text" id="sample6_detailAddress" placeholder="상세주소" class="full_width" value="{{old('detail_address', $user->detail_address)}}"/>{!! $errors->first('detail_address','<span class="red">:message</span>')!!}</span>			
						</dd>			
					</dl>
                    <dl>
						<dt>성별</dt>
						<dd class="{{ $errors->has('gender') ? 'has-error' : '' }} mt10"><span class="input-button"><input type="radio" name="gender" value="f" @if(old('gender', $user->gender)=='f') checked @endif id="female"><label for="female">여자</label></span>
								<span class="input-button"><input type="radio" name="gender" value="m" @if(old('gender', $user->gender)=='m') checked @endif id="male"><label for="male">남자</label></span>
                                {!! $errors->first('gender','<span class="red">:message</span>')!!}</span></dd>
					</dl>
				</div>
				<!-- //기본정보 입력 -->

				<div class="join_btn_wrap">
<!--					<a href="#" class="btn">취소</a>-->
					<button type="submit" class="btn black">수정하기</button>
				</div>
				</form>
			</div>
			<!-- //오른쪽 컨텐츠 -->
		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>
@include('help.addjs')
@include('reviewers.reviewer_bottommenu')
@endsection