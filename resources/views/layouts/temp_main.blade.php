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

	<meta property="og:type" content="website">
	<meta property="og:url"	content="">
	<!--meta property="og:image" content="/img/common/snsicon.jpg">
	<meta property="og:description" content="">
	<link rel="shortcut icon" type="image/x-icon" href="/img/common/favicon.ico" />
	<link rel="icon" href="/img/common/favicon.png"-->
	<!-- font -->
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR:100,300,400,500,700&amp;subset=korean" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800&display=swap" rel="stylesheet">
	<!-- css -->
<!--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">-->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    
    <link href="{{ asset('plugin/slick-1.8.1/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('plugin/slick-1.8.1/slick-theme.css') }}" rel="stylesheet">
	<!-- script -->
	<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="{{ asset('plugin/slick-1.8.1/slick.js') }}"></script>
<!--    <script src="{{ asset('js/app.js') }}" defer></script>-->
    <script src="{{ asset('js/main.js') }}" defer></script>
    <title>{{ config('app.name') }}</title>
    <meta name="title" content="{{ config('app.name') }}"/>
    <meta property="og:title" content="{{ config('app.name') }}">  	
</head>

<body>
<div class="wrap" id="page_top">
<div class="header_wrap">
	<div class="header">
		<h1 style="left:50%;transform:translate(-50%,0);"><a href="{{route('temp_home')}}"><img src="/img/main/logo.png" alt="{{ config('app.name') }}" /></a></h1>
	</div>
</div>

{{-- Success Alert --}}
    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('status')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- Error Alert --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{session('error')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
            @yield('content')

	<!-- 상단으로 -->
	<p class="btn-top"><a href="#page_top"><img src="/img/common/btn_top.png" alt="상단으로"></a></p>

	<!--  푸터 S -->
	<footer>
		<div class="footer-call">
			<p>고객센터</p>
			<b class=""><a href="tel:051-256-2735">051-256-2735</a></b>
			<small>월-금  오전 9시 - 오후 6시 /  주말, 공휴일 휴무</small>
			<p class="f-btn">
				<a href="/cscenter/faq.php">FAQ</a>
				<a href="/cscenter/ask.php">1:1 문의</a>
			</p>
		</div>
		<div class="footer">
			<div class="footer-link">
				<ul class="footer-link-lists">
					<li><a href="#">서비스소개</a>｜</li>
					<li><a href="#">이용약관</a>｜</li>
					<li><a href="#">개인정보처리방침</a>｜</li>
					<li class="br0"><a href="#">운영정책</a></li>
				</ul>	
			</div>
			<div class="footer-txt">
				<p>{{ config('app.name') }}<small>|</small>대표 : 조용완</p>
				<p>
					<span>48547 부산광역시 남구 신선로 365, 317호 (부산창업지원센터, 감만동)<small class="m-none">|</small></span>
					<span>MAIL : bloxion@naver.com<small class="pc-none">|</small></span>
					<span>사업자등록번호 : 381-69-00094<small class="m-none">|</small></span>
					<span>통신판매업 신고번호 :  제 2017-부산사하-0040 호<small class="m-none">|</small></span>
					<span>개인정보보호책임 : 김성근</span>
				</p>
				<p class="copyright">© 2019.BLOXION. ALL RIGHTS RESERVED.</p>
			</div>
		</div>
	</footer>
	<!-- //푸터 E -->
</div><!-- //.wrap -->

</body>
</html>