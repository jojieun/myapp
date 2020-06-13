@extends('layouts.main')
@section('content')

			@include('advertisers.advertiser_leftmenu')	
                        <!-- 오른쪽 컨텐츠 -->
<div class="right-content">
				<h2 class="mb70 m-text-left">회원정보수정</h2>		

				<form method="post" action="{{ route('advertisers.update_self', $user->id) }}">
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
						<dd class="{{ $errors->has('origin_pw') ? 'has-error' : '' }}"><input name="origin_pw" type="password" id="" value="" class="full_width" />{!! $errors->first('origin_pw','<span class="red">:message</span>')!!}</dd>
					</dl>
					<dl>
						<dt class="{{ $errors->has('password') ? 'has-error' : '' }}">새 비밀번호</dt>
						<dd><input name="password" type="password" id="" placeholder="비밀번호(최소 8자이상)" class="full_width" />
                        {!! $errors->first('password','<span class="red">:message</span>')!!}</dd>
					</dl>
					<dl>
						<dt>비밀번호 확인</dt>
						<dd class="{{ $errors->has('password_confirmation') ? 'has-error' : '' }}"><input name="password_confirmation" type="password" id="" placeholder="비밀번호(최소 8자이상)" class="full_width" />
                        {!! $errors->first('password_confirmation','<span class="red">:message</span>')!!}</dd>
					</dl>
					<dl>
						<dt>이름</dt>
						<dd class="{{ $errors->has('name') ? 'has-error' : '' }}"><input name="name" type="text" id="" value="{{old('name', $user->name)}}" class="full_width" />
                        {!! $errors->first('name','<span class="red">:message</span>')!!}</dd>
					</dl>
					<dl>
						<dt>휴대폰번호</dt>
						<dd class="{{ $errors->has('mobile_num') ? 'has-error' : '' }}"><input name="mobile_num" type="text" id="" value="{{old('mobile_num', $user->mobile_num)}}" class="w150"/><button type="button" name="button" class="btn btn-check">인증번호 발송</button>
                        {!! $errors->first('mobile_num','<span class="red">:message</span>')!!}</dd>
					</dl>
				</div>
				<!-- //기본정보 입력 -->

				<div class="join_btn_wrap">
<!--					<a href="#" class="btn">취소</a>-->
					<button type="submit" class="btn black">수정하기</button>
				</div>
				</form>
			</div>
		</div>
			<!-- //오른쪽 컨텐츠 -->

@include('advertisers.advertiser_leftmenu_tail')
@endsection