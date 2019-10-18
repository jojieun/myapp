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
				<form method="post" name="{{ route('remind.store') }}" role="form" class="form__auth">
                    {!! csrf_field() !!}
					<div class="login-group">
						<p class="form-group">
							<label for="">이메일</label>
							<input type="email" name="email" id="" class="full_width" value="{{old('email')}}" placeholder="가입한 이메일을 입력하세요.">
                            {!! $errors->first('email','<span class="red">:message</span>')!!}	
						</p>
						<p class="{{ $errors->has('mobile_num') ? 'has-error' : '' }}">
                            <label for="">휴대폰 번호</label>
                <input type="tel" name="mobile_num" placeholder="'-'없이 숫자만 입력해주세요!" value="{{old('mobile_num')}}" class="w200" maxlength="20"><button type="button" name="button" class="btn btn-check w200">인증번호 발송</button>
                {!! $errors->first('mobile_num','<span class="red">:message</span>')!!}
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