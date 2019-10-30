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
    <a href="" id="logo">{{ config('app.name') }} 관리자페이지</a>
    <nav id="gnb">
        <ul>
            <li>
                <a href="">로그아웃</a>
            </li>
            <li>
                <a href="{{ route('main') }}">사이트메인으로</a>
            </li>
        </ul>
    </nav>
    <nav id="main_nav">
        <ul>
            <li class="main">
                <a href="" class="main_a">캠페인관리</a>
                <ul class="sub">
                    <li><a href="">하위메뉴</a></li>
                    <li><a href="">하위메뉴</a></li>
                    <li><a href="">하위메뉴</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    </header>
    <div id="con">
        @yield('content')
    </div>
</body>
</html>