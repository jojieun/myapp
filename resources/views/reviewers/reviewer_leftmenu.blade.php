<span class="m-bar2"></span>
	<!-- 모바일 마이페이지 -->
	<p class="m-top-title">
		<b class="name">{{$user->name}}님</b>
		<span>{{$user->email}}</span>
	</p>
	<!-- //모바일 마이페이지 -->
	<div class="sub-container bt-ddd w-pc-fixed">		

		<!-- 상세 컨텐츠내용 -->
		<div class="content-in-sub">
			<!-- 왼쪽메뉴 -->		
		  <div class="leftmenu">
		  	<p class="leftmenu-title">
		  		<b class="name">{{ $user->nickname }}님</b>
		  		<span>{{ $user->email }}</span>
		  	</p>
		  	<ul> 
		  		<li class="on"><a href="reviewer_0101.php"><span>나의 캠페인</span></a></li>
		  		<li><a href="reviewer_0201.php"><span>미제출 리뷰</span></a></li>
		  		<li><a href="reviewer_0301.php"><span>나의 리뷰전략 관리</span></a></li>
		  		<li><a href="reviewer_0401.php"><span>리뷰전략 열람 정보</span></a></li>
		  		<li><a href="reviewer_0501.php"><span>리뷰어 제안</span></a></li>
		  		<li><a href="reviewer_0601.php"><span>관심 캠페인</span></a></li>
		  		<li><a href="reviewer_0701.php"><span>나의 포인트</span></a></li>
		  		<li><a href="reviewer_0801.php"><span>회원정보수정</span></a></li>
		  		<li class="fw-500"><a href="reviewer_0901.php"><span>mySNS</span></a>
		  			<p class="sns">
		  				<span class="ico-blog @if(!$user->naver_blog) off @endif"></span>
		  				<span class="ico-post @if(!$user->naver_post) off @endif"></span>
		  				<span class="ico-facebook @if(!$user->facebook) off @endif"></span>
		  				<span class="ico-insta @if(!$user->instagram) off @endif"></span>
		  				<span class="ico-kakao @if(!$user->kakao) off @endif"></span>
		  				<span class="ico-youtube @if(!$user->youtube) off @endif"></span>
		  			</p>
		  		</li>
		  	</ul>
		  </div>

                