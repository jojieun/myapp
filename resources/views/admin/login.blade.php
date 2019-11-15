<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="robots" content="INDEX, FOLLOW"/>
	<meta name="Description" content="">
	<meta name="Author" content="">
	<meta name="Keywords" content="">
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=5.0, user-scalable=yes,target-densitydpi=device-dpi">	
     <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/adminstyle.css') }}" rel="stylesheet">
	<!-- script -->
	<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="{{ asset('js/admin.js') }}" defer></script>
    <title>{{ config('app.name') }} 관리자페이지</title>
</head>
<body>
<header id="main_header">
    <a href="{{ route('admin') }}" id="logo">{{ config('app.name') }} 관리자페이지</a>
    <nav id="gnb">
        <ul>            
            <li>
                @if(Auth::guard('admin')->check())
                <a href="{{route('admin.logout')}}">로그아웃</a>
                @else
                <a href="{{route('admin.login')}}">로그인</a>
                @endif
            </li>
            <li>
                <a href="{{ route('main') }}">사이트메인으로</a>
            </li>
        </ul>
    </nav>
    </header>
    <div id="con">
			<h2 class="m-text-left">
				<b>관리자로그인</b>
			</h2>

			<div class="login-wrap">
				<form action="{{ route('admin.loginstore') }}" method="post" class="form__auth">
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
                        <p>
                        <button type="submit">로그인</button>
                        </p>
					</div>
				</form> 
			</div>
		</div>
</body>
</html>