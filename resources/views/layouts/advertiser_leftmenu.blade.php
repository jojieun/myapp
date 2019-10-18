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
				<b class="name">{{$user->name}}님</b>
				<span>{{$user->email}}</span>
			</p>
			<ul> 
				<li class="on"><a href="client_0101.php"><span>캠페인 등록</span></a></li>
				<li><a href="client_0201.php"><span>캠페인 관리</span></a></li>
				<li><a href="#"><span>인플루언서 검색</span></a></li>
				<li><a href="#"><span>캠페인 대행 의뢰</span></a></li>
				<li><a href="client_0501.php"><span>회원정보수정</span></a></li>
			</ul>
		</div>
