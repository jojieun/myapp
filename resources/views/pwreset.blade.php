@extends('layouts.main')

@section('content')
<div class="sub-container bt-ddd bg-smile m-top-bar">
		<!-- 상세 컨텐츠내용 -->	
		<div class="content-in-sub member">
			<h2 class="m-text-left">
				<b>비밀번호 찾기</b>
				<p>비밀번호를 잊어버리셨나요?</p>
			</h2>
			<div class="login-wrap">
				<p class="h4"><span>비밀번호 재설정</span></p>
				<form method="post" action="{{ route('reset.store') }}" role="form" class="form__auth">
                    {!! csrf_field() !!}
                    <input type='hidden' name="email" value="@if($email){{ $email }}@else{{ old('email') }}@endif">
                    <input type="hidden" name="who" value="@if($who){{ $who }}@else{{ old('who') }}@endif">
					<div class="login-group">
						<p class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
							<label for="">새비밀번호</label>
							<input type="password" name="password" placeholder="비밀번호(영문과 숫자를 혼합해서 8자 이상)" />
                            {!! $errors->first('password','<span class="red">:message</span>')!!}
						</p>
						<p class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                            <label for="">비밀번호확인</label>
               <input type="password" name="password_confirmation" placeholder="비밀번호 확인" />
                            {!! $errors->first('password_confirmation','<span class="red">:message</span>')!!}
						</p>
						<div class="login-group">
							<button type="button" class="btn w50" onclick="window.history.back();">취소</button>
							<button type="submit" class="btn black w50 fl-r">비밀번호 재설정</button>
						</div>
					</div>
				</form>
			</div>

		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>
@endsection