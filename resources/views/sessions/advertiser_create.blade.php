@extends('layouts.main')
@section('content')

<div class="sub-container bt-ddd bg-smile m-top-bar">
		<!-- 상세 컨텐츠내용 -->	
		<div class="content-in-sub member ">

			<h2 class="m-text-left">
				<b>로그인</b>
				<p>{{ config('app.name') }}에 오신것을 환영합니다:)</p>
			</h2>
			<!-- 탭-->				
			<ul class="detail_tab">
				<li><a href="{{route('sessions.create')}}">리뷰어</a></li>
				<li><a href="{{route('advertiser_sessions.create')}}" class="on">광고주</a></li>
			</ul>
			<!-- //탭-->

			<div class="login-wrap">
				<form action="{{ route('advertiser_sessions.store') }}" method="post" class="form__auth">
                     {!! csrf_field() !!}
                    @include('flash::message')
					<div class="login-group">
						<p class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
							<label for="">이메일</label>
                            <input type="email" name="email" class="form-control full_width" placeholder="이메일을 입력해주세요." value="{{ old('email') }}" autofocus/>
                            {!! $errors->first('email', '<span class="red">:message</span>') !!}
						</p>
						<p class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
							<label for="">비밀번호</label>
                            <input type="password" name="password" maxlength="20" class="form-control full_width" placeholder="비밀번호를 입력해주세요.">
                            {!! $errors->first('password', '<span class="red">:message</span>')!!}
						</p>
						<div class="login-group">
							<button type="submit" class="btn full_width black">광고주 로그인</button>
						</div>
						<div class="id-save">
							<span class="input-button"><input type="checkbox"  name="remember" value="{{ old('remember', 1) }}" checked><label for="">자동로그인</label></span>
						</div>
						<ul class="link">
							<li><a href="mailfind.php">가입이메일 찾기</a></li>
							<li><a href="{{ route('remind.create') }}">비밀번호 찾기</a></li>
						</ul>
					</div>
				</form>
				<div class="btn-join">
					<span>{{ config('app.name') }}에서 직접 체험단을 모집해보세요:) </span>
					<a href="{{ route('advertisers.create') }}" class="btn">광고주 회원가입</a>
				</div>	 
			</div>
		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>
@endsection