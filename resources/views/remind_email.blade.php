@extends('layouts.main')

@section('content')
	<div class="sub-container bt-ddd bg-smile m-top-bar">
		<!-- 상세 컨텐츠내용 -->	
		<div class="content-in-sub member">
			<h2 class="m-text-left">
				<b>가입 이메일 찾기</b>
				<p>가입 이메일을 잊어버리셨나요?</p>
			</h2>

			<div class="login-wrap">
				<p class="h4"><span>휴대폰 번호로 찾기</span></p>
				
				<form method="post" action="{{ route('remind_email.store') }}" role="form" class="form__auth">
                    {!! csrf_field() !!}
                    @include('flash::message')
					<div class="login-group">
						<p>
							<label for="">이름</label>
							<input type="text" name="name" id="" class="full_width" value="{{old('name')}}" placeholder="가입 이름을 입력해주세요.">
						</p>
						<p>
							<label for="">휴대폰 번호</label>
							<input type="tel" name="mobile_num" id="" maxlength="20" class="full_width" value="{{old('mobile_num')}}" placeholder="가입 휴대폰 번호 ( ‘-’ 없이 숫자만 입력하세요  )">
						</p>
						<div class="login-group">
							<button type="button" class="btn w50">취소</button>
							<button type="submit" class="btn black w50 fl-r">이메일찾기</button>
						</div>
					</div>
				</form>
			</div>

		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>
@endsection