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
	<link rel="stylesheet" type="text/css" href="/include/css/style.css" />
	<link rel="stylesheet" type="text/css" href="/include/plugin/slick-1.8.1/slick.css" />
	<link rel="stylesheet" type="text/css" href="/include/plugin/slick-1.8.1/slick-theme.css" />
	<!-- script -->
	<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script src="/include/plugin/slick-1.8.1/slick.js"></script>	
	<script type="text/javascript" src="/include/js/main.js"></script>
    <title>블록션</title>
    <meta name="title" content="블록션"/>
    <meta property="og:title" content="블록션">  	
</head>

<body>
<div class="wrap" id="page_top">
<div class="header_wrap">
	<div class="header">
		<h1><a href="/index.php"><img src="/img/main/logo.png" alt="블록션" /></a></h1>
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
								<span class="search"><input name="" type="text" placeholder="검색어를 입력해주세요" ><a href="#"><img src="/img/common/ico_search.gif" alt="검색" /></a></span>
								<span id="close_menu"><a title="가변폭 전체메뉴 닫기버튼">&nbsp;</a></span>
							</li>
							<li class="pc-none m-login">
								<!--로그인 전 -->
								<!--span><a href="/member/login.php">로그인</a></span>
								<span><a href="/member/join_step1.php">회원가입</a></span>
								<!--//로그인 전 -->
								<!--로그인 후 -->
								<span class="my"><a href="#"><img src="/img/main/my.jpg" alt="">조조님</a></span>
								<span class="logout"><a href="#">로그아웃</a></span>
								<!--//로그인 후 -->
							</li>
							<li><a href="/sub/campaign_list.php"  class="mainmenu" id="mainmenu01"><b>방문</b></a></li>
							<li><a href="/sub/campaign_list2.php"  class="mainmenu" id="mainmenu02"><b>재택</b></a></li>
							<li class="mainMenu"><a href="/sub/campaign_list.php"  class="mainmenu" id="mainmenu03">고객센터</a>						
								<ol class="submenu depth" id="submenu03" style="display:none;">
									<li><a href="/cscenter/ask.php">1:1 문의하기</a></li>
									<li><a href="/cscenter/faq.php">FAQ</a></li>
									<li><a href="/cscenter/notice_list.php">공지사항</a></li>
									<li><a href="/cscenter/ask_list.php">문의내역</a></li>
								</ol>
							</li>
							<li><a href="/community/list.php"  class="mainmenu" id="mainmenu04">커뮤니티</a></li>	
							<li><a href="#"  class="mainmenu" id="mainmenu05"><b>인플루언서</b></a></li>
						</ul>
						<div class="" name="back_z" id="back_z" style="left: 0px; display: block;"></div>
					</div>
				</div>
			</div>
		</div>
		<!-- //상단메뉴 출력-->

		<ul class="topmenu">
			<li class="search">
				<input name="" type="text"><a href="#"><img src="/img/common/ico_search.gif" alt="검색"></a>
			</li>
			<!--로그인 전 -->
			<li><a href="/member/login.php">LOGIN</a></li>
			<li><a href="/member/join_step1.php">JOIN</a></li>
			<!--//로그인 전 -->
			<!--로그인 후 -->
			<!--li class="my">
				<a href="#"><img src="/img/main/my.jpg" alt="">조조님</a>
				<ul class="my_list" style="display:none">
					<li><a href="#"><span>마이페이지</span></a></li>
					<li><a href="#"><span>로그아웃</span></a></li>
				</ul>
			</li>
			<!--//로그인 후 -->
		</ul>
	</div>
</div>