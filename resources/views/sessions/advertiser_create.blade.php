@extends('layouts.main')
@section('content')

<div class="sub-container bt-ddd bg-smile m-top-bar">
		<!-- 상세 컨텐츠내용 -->	
		<div class="content-in-sub member ">

			<h2 class="m-text-left">
				<b>로그인</b>
				<p>블록션에 오신것을 환영합니다:)</p>
			</h2>
			<!-- 탭-->				
			<ul class="detail_tab">
				<li><a href="{{route('sessions.create')}}">리뷰어</a></li>
				<li><a href="{{route('advertiser_sessions.create')}}" class="on">광고주</a></li>
			</ul>
			<!-- //탭-->

			<div class="login-wrap">
				<form method="post" name="">
					<div class="login-group">
						<p>
							<label for="">아이디</label>
							<input type="text" name="" id="" class="full_width" value="" placeholder="아이디를 입력해주세요.">
						</p>
						<p>
							<label for="">비밀번호</label>
							<input type="password" name="" id="" maxlength="20" class="full_width" placeholder="비밀번호를 입력해주세요.">
						</p>
						<div class="login-group">
							<button type="submit" class="btn full_width black">로그인</button>
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
					<span>블록션에서 다양한 체험을 경험해보세요:) </span>
					<a href="{{ route('advertisers.create') }}" class="btn">광고주 회원가입</a>
				</div>	 
			</div>
		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>

<h1>로그인</h1>
<form action="{{ route('advertiser_sessions.store') }}" method="post" class="form__auth">
    {!! csrf_field() !!}
    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
      <input type="email" name="email" class="form-control" placeholder="이메일" value="{{ old('email') }}" autofocus/>
      {!! $errors->first('email', '<span class="form-error">:message</span>') !!}
    </div>

    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
      <input type="password" name="password" class="form-control" placeholder="패스워드">
      {!! $errors->first('password', '<span class="form-error">:message</span>')!!}
    </div>
    <div class="form-group">
      <div class="checkbox">
        <label>
          <input type="checkbox" name="remember" value="{{ old('remember', 1) }}" checked>
          로그인 기억하기
          <span class="text-danger">
            공용 컴퓨터에서는 사용하지 마세요
          </span>
        </label>
      </div>
    </div>
    <div class="form-group">
      <button class="btn btn-primary btn-lg btn-block" type="submit">
        로그인하기
      </button>
    </div>
    <div>
      <p class="text-center">
          <a href="{{ route('advertisers.create') }}">가입하기</a>
      </p>
      <p class="text-center">
        <a href="{{ route('remind.create') }}">비밀번호찾기</a>
      </p>
    </div>
</form>
@endsection