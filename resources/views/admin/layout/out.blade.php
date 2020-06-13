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
    <link href="{{ asset('css/adminstyle.css?v=0.3') }}" rel="stylesheet">
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
            @if(Auth::guard('admin')->check())
            <li>
                <a href="{{route('admins.edit',Auth::guard('admin')->user()->id)}}">{{Auth::guard('admin')->user()->name}}(정보수정)</a>
            </li>
            <li>
                
                <a href="{{route('admin.logout')}}">로그아웃</a>
            </li>
            @else
            <li>
                <a href="{{route('admin.login')}}">로그인</a>
            </li>
            @endif
            <li>
                <a href="{{ route('main') }}">사이트메인으로</a>
            </li>
        </ul>
    </nav>
    </header>
    <div id="con">
        @yield('content')
    </div>
</body>
</html>