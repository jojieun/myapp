<!DOCTYPE html>
<html lang="ko">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-163840965-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-163840965-1');
</script>
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
	<!--파비콘-->
    <link rel="apple-touch-icon" sizes="57x57" href="favi/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="favi/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="favi/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="favi/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="favi/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="favi/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="favi/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="favi/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="favi/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="favi/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="favi/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="favi/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="favi/favicon-16x16.png">
<link rel="manifest" href="favi/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="favi/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
	<!-- font -->
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR:100,300,400,500,700&amp;subset=korean" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800&display=swap" rel="stylesheet">
	<!-- css -->
<!--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">-->
    <link href="{{ asset('css/style.css?ver=1.8') }}" rel="stylesheet">
    
    <link href="{{ asset('plugin/slick-1.8.1/slick.css?ver=0.2') }}" rel="stylesheet">
    <link href="{{ asset('plugin/slick-1.8.1/slick-theme.css?ver=0.2') }}" rel="stylesheet">
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
		<h1><a href="{{route('main')}}"><img src="/img/main/logo.png" alt="{{ config('app.name') }}" /></a></h1>
		<!-- 상단메뉴 출력-->
		<div class="gnb_area">
			<div class="gnb_box">
				<a id="btn_menulist_view">
					<img src="/img/common/ico_search.gif" alt="검색" class="btn-top-search" />
					<img src="/img/main/btn_menulist.png" alt="메뉴리스트출력" />
				</a>
				<div class="main_menus_wrap">
					<div class="main_menus">
						<ul class="menulists_xtype" id="main_menus">
							<li class="search-box pc-none">
								<span class="search"><form method="get" action="{{route('search')}}" class="search_form"><input name="search_word" type="text" placeholder="검색어를 입력해주세요" ><button type="submit"><img src="/img/common/ico_search.gif" alt="검색" /></button></form></span>
								<span id="close_menu"><a title="가변폭 전체메뉴 닫기버튼">&nbsp;</a></span>
							</li>
							<li class="pc-none m-login">
                                @if(Auth::guard('web')->check())
                                <span class="my"><a href="{{route('reviewers.mypage')}}"><img src="/img/main/my.jpg" alt="">{{ Auth::user()->nickname }}님</a></span>
								<span class="logout"><a href="{{route('sessions.destory')}}">로그아웃</a></span>
                                @elseif(Auth::guard('advertiser')->check())
                                <span class="my"><a href="{{route('advertisers.mypage')}}"><img src="/img/main/my.jpg" alt="">{{ auth()->guard('advertiser')->user()->name }}님</a></span>
								<span class="logout"><a href="{{route('advertiser_sessions.destory')}}">로그아웃</a></span>
                                @elseif(Auth::guard('admin')->check())
                                <span class="my"><a href="{{route('admin')}}">{{ auth()->guard('admin')->user()->name }}님</a></span>
								<span class="logout"><a href="{{route('admin.logout')}}">로그아웃</a></span>
								@else
								<span><a href="{{route('sessions.create')}}">로그인</a></span>
								<span><a href="{{route('register.select')}}">회원가입</a></span>
                                @endif
							</li>
							<li><a href="{{route('visit')}}"  class="mainmenu" id="mainmenu01"><b>방문</b></a></li>
							<li><a href="{{route('athome')}}"  class="mainmenu" id="mainmenu02"><b>재택</b></a></li>
                            <li><a href="{{ route('communities.index') }}"  class="mainmenu" id="mainmenu04">커뮤니티</a></li>
							<li class="mainMenu"><a href="{{route('reviewer_faqs.index')}}"  class="mainmenu" id="mainmenu03">고객센터</a>
								<ol class="submenu depth" id="submenu03" style="display:none;">
									<li><a href="{{route('onetoones.create')}}">1:1 문의하기</a></li>
									<li><a href="{{route('reviewer_faqs.index')}}">FAQ</a></li>
									<li><a href="{{route('notices.index')}}">공지사항</a></li>
									<li><a href="{{route('onetoones.index')}}">문의내역</a></li>
								</ol>
							</li>
								
							<li><a href="{{route('influencers.index')}}"  class="mainmenu" id="mainmenu05"><b>인플루언서</b></a></li>
						</ul>
						<div class="" name="back_z" id="back_z" style="left: 0px; display: block;"></div>
					</div>
				</div>
			</div>
		</div>
		<!-- //상단메뉴 출력-->

		<ul class="topmenu">
			<li class="search">
				<form method="get" action="{{route('search')}}" class="search_form"><input name="search_word" type="text"><button type="submit"><img src="/img/common/ico_search.gif" alt="검색"></button>
                </form>
			</li>
			@if(Auth::guard('web')->check())
            <li class="my">
				<a href="{{route('reviewers.mypage')}}"><img src="/img/main/my.jpg" alt="">{{ Auth::user()->nickname }}님</a>
				<ul class="my_list" style="display:none">
					<li><a href="{{route('reviewers.mypage')}}"><span>마이페이지</span></a></li>
					<li><a href="{{route('sessions.destory')}}"><span>로그아웃</span></a></li>
				</ul>
			</li>
            @elseif(Auth::guard('advertiser')->check())
            <li class="my">
				<a href="{{route('advertisers.mypage')}}"><img src="/img/main/my.jpg" alt="">{{ auth()->guard('advertiser')->user()->name }}님</a>
				<ul class="my_list" style="display:none">
					<li><a href="{{route('advertisers.mypage')}}"><span>마이페이지</span></a></li>
					<li><a href="{{route('advertiser_sessions.destory')}}"><span>로그아웃</span></a></li>
				</ul>
			</li>
            @elseif(Auth::guard('admin')->check())
            <li class="my">
				<a href="{{route('admin')}}">{{ auth()->guard('admin')->user()->name }}님</a>
				<ul class="my_list" style="display:none">
					<li><a href="{{route('admin')}}"><span>관리자페이지</span></a></li>
					<li><a href="{{route('admin.logout')}}"><span>로그아웃</span></a></li>
				</ul>
			</li>
            @else
            <li><a href="{{route('sessions.create')}}">LOGIN</a></li>
			<li><a href="{{route('register.select')}}">JOIN</a></li>
			@endif
		</ul>
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
			<b class=""><a href="tel:051-256-2735">070-4348-2627</a></b>
			<small>월-금  오전 9시 - 오후 6시 /  주말, 공휴일 휴무</small>
			<p class="f-btn">
				<a href="{{route('reviewer_faqs.index')}}">FAQ</a>
				<a href="{{route('onetoones.create')}}">1:1 문의</a>
			</p>
		</div>
		<div class="footer">
			<div class="footer-link">
				<ul class="footer-link-lists">
					<li><a href="{{route('temp_home')}}">서비스소개</a>｜</li>
					<li><a href="{{route('terms_of_use')}}">이용약관</a>｜</li>
					<li><a href="{{route('privacy_policy')}}">개인정보처리방침</a>｜</li>
					<li class="br0"><a href="#">운영정책</a></li>
				</ul>	
			</div>
			<div class="footer-txt">
				<p>스트롱애드<small>|</small>대표 : 조용완</p>
				<p>
					<span>(48500) 부산광역시 남구 용소로46번길 7, 5층<small class="m-none">|</small></span>
					<span>MAIL : help@review-power.com<small class="pc-none">|</small></span>
					<span>사업자등록번호 : 381-69-00094<small class="m-none">|</small></span>
					<span>통신판매업 신고번호 :  제 2017-부산사하-0040 호<small class="m-none">|</small></span>
					<span>개인정보보호책임 : 김성근</span>
				</p>
				<p class="copyright">© 2019.STRONGAD. ALL RIGHTS RESERVED.</p>
			</div>
		</div>
	</footer>
	<!-- //푸터 E -->
</div><!-- //.wrap -->

</body>
</html>
<script>
$('.search_form').submit(function(){
    if($('input[name=search_word]').eq(0).val()||$('input[name=search_word]').eq(1).val()){
        return true;
    }else{
        alert('검색어를 입력해주세요');
        return false;
    }
})
</script>