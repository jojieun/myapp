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
				<li><a href="{{route('sessions.create')}}" class="on">리뷰어</a></li>
				<li><a href="{{route('advertiser_sessions.create')}}">광고주</a></li>
			</ul>
			<!-- //탭-->

			<div class="login-wrap">
				<form action="{{ route('sessions.store') }}" method="post" class="form__auth">
    {!! csrf_field() !!}
					<div class="login-group">
						<p class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
							<label for="">이메일</label>
                            <input type="email" name="email" class="full_width form-control" value="{{ old('email') }}" autofocus placeholder="이메일을 입력해주세요."/>
      {!! $errors->first('email', '<span class="red">:message</span>') !!}
						</p>
						<p class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
							<label for="">비밀번호</label>
                            <input type="password" name="password" class="form-control full_width" maxlength="20" placeholder="비밀번호를 입력해주세요.">
      {!! $errors->first('password', '<span class="red">:message</span>')!!}
						</p>
						<div class="login-group">
							<button type="submit" class="btn full_width black">리뷰어 로그인</button>
						</div>
						<div class="id-save">
							<span class="input-button"><input type="checkbox" name="" id="" value="Y"><label for="">자동로그인</label></span>
						</div>
						<ul class="link">
							<li><a href="mailfind.php">가입이메일 찾기</a></li>
							<li><a href="pwfind.php">비밀번호 찾기</a></li>
						</ul>
					</div>
				</form>
				<div class="btn-join">
					<span>{{ config('app.name') }}에서 다양한 체험을 경험해보세요:) </span>
					<a href="{{route('reviewers.create')}}" class="btn">리뷰어 회원가입</a>
				</div>
				<div class="sns-login">
					<ul>
						<li><a href="#">네이버 로그인</a></li>
						<li><a href="#">인스타그램 로그인</a></li>
						<li><a href="#">카카오 로그인</a></li>
						<li><a href="#">구글 로그인</a></li>
					</ul>
				</div>	 
			</div>
		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>
@endsection