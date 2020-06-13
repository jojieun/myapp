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
    <nav id="main_nav">
        <ul>
            <li class="main">
                <a href="{{route('admin.reviewers')}}" class="main_a">회원관리</a>
                <ul class="sub">
                    <li><a href="{{route('admin.reviewers')}}">리뷰어회원</a></li>
                    <li><a href="{{route('admin.advertisers')}}">광고주회원</a></li>
                    @if(Auth::guard('admin')->user()->authority == 10)
                    <li><a href="{{route('admins.index')}}">관리자</a></li>
                    @endif
                </ul>
            </li>
            <li class="main">
                <a href="{{route('admin.waitConfirmCam')}}" class="main_a">캠페인관리</a>
                <ul class="sub">
                    <li><a href="{{route('admin.waitConfirmCam')}}">검수대기중 캠페인</a></li>
                    <li><a href="{{route('admin.modify_campaign')}}">수정요청 캠페인</a></li>
                    <li><a href="{{route('admin.recruit_cam')}}">리뷰어 모집중 캠페인</a></li>
                    <li><a href="{{route('admin.submit_cam')}}">리뷰 진행중 캠페인</a></li>
                    <li><a href="{{route('admin.end_cam')}}">완료 캠페인</a></li>
                    <li><a href="{{route('admin.black_list')}}">미제출 리뷰어(블랙리스트)</a></li>
                </ul>
            </li>
            <li class="main">
                <a href="{{route('admin.exposure_purchase')}}" class="main_a">캠페인옵션관리</a>
                <ul class="sub">
                    <li><a href="{{route('admin.exposure_purchase')}}">캠페인 노출옵션 구매내역</a></li>
                    <li><a href="{{route('admin.promotion_purchase')}}">캠페인 홍보옵션 구매내역</a></li>
                    <li><a href="{{route('admin.exposure')}}">캠페인 노출 옵션 설정</a></li>
                    <li><a href="{{route('admin.promotion')}}">캠페인 홍보 옵션 설정</a></li>
                </ul>
            </li>
            <li class="main">
                <a href="{{route('admin.agency')}}" class="main_a">캠페인 대행 의뢰</a>
            </li>
            <li class="main">
                <a href="{{route('admin.notanswer')}}" class="main_a">1:1문의</a>
                <ul class="sub">
                    <li><a href="{{route('admin.notanswer')}}">미답변</a></li>
                    <li><a href="{{route('admin.answer')}}">답변완료</a></li>
                    <li><a href="{{route('admin.showQCategory')}}">문의 카테고리 관리</a></li>
                </ul>
            </li>
            <li class="main">
                <a href="{{route('admin.apply_deposits')}}" class="main_a">리뷰어 포인트 출금신청</a>
                <ul class="sub">
                    <li><a href="{{route('admin.apply_deposits')}}">출금신청내역</a></li>
                    <li><a href="{{route('admin.complete_deposits')}}">출금완료내역</a></li>
                </ul>
            </li>
            <li class="main">
                <a href="{{route('admin.rFAQCategory')}}" class="main_a">FAQ</a>
                <ul class="sub">
                    <li><a href="{{route('admin.rFAQCategory')}}">리뷰어FAQ 카테고리 관리</a></li>
                    <li><a href="{{route('reviewer_faqs.create')}}">리뷰어FAQ 관리</a></li>
                    <li><a href="{{route('admin.aFAQCategory')}}">광고주FAQ 카테고리 관리</a></li>
                    <li><a href="{{route('advertiser_faqs.create')}}">광고주FAQ 관리</a></li>
                </ul>
            </li>
            <li class="main">
                <a href="{{route('notices.create')}}" class="main_a">공지사항</a>
            </li>
            <li class="main">
                <a href="{{route('admin.main_banner_edit')}}" class="main_a">배너관리</a>
                <ul class="sub">
                    <li><a href="{{route('admin.main_banner_edit')}}">메인배너관리</a></li>
                    <li><a href="{{route('admin.middle_banner_edit')}}">중단배너관리</a></li>
                    <li><a href="{{route('admin.bottom_banner_edit')}}">하단배너관리</a></li>
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