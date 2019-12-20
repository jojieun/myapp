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
				<a href="{{ route('advertisers.mypage') }}"><b class="name">{{$user->name}}님</b></a>
				<span>{{$user->email}}</span>
                
			</p>
			<ul> 
				<li @if(Request::segment(1)=='campaigns')class="on"@endif><a href="{{ route('campaigns.create') }}"><span>캠페인 등록</span></a></li>
				<li @if(Request::segment(2)=='managecampaign')class="on"@endif><a href="{{ route('advertisers.managecampaign').'#waitCampaigns' }}"><span>캠페인 관리</span></a></li>
<!--				<li @if(Request::segment(2)=='')class="on"@endif><a href="#"><span>인플루언서 검색</span></a></li>-->
				<li @if(Request::segment(2)=='agency')class="on"@endif><a href="{{ route('agency.index') }}"><span>캠페인 대행 의뢰</span></a></li>
				<li @if(Request::segment(2)=='edit_info')class="on"@endif><a href="{{ route('advertisers.edit_info') }}"><span>회원정보수정</span></a></li>
			</ul>
		</div>
