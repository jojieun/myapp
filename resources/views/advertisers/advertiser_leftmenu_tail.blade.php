		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>
	<!-- 모바일 메뉴 -->
	<ul class="campaign_tab2">
		<li @if(Request::segment(1)=='campaigns')class="on"@endif><a class="out" href="{{ route('campaigns.create') }}"><span>캠페인<br/>등록</span></a></li>
		<li @if(Request::segment(2)=='managecampaign')class="on"@endif><a class="out" href="{{ route('advertisers.managecampaign').'#waitCampaigns' }}"><span>캠페인<br/>관리</span></a></li>
<!--		<li @if(Request::segment(2)=='')class="on"@endif><a href="{{ route('campaigns.create') }}"><span>인플루언서<br/>검색</span></a></li>-->
		<li @if(Request::segment(2)=='agency')class="on"@endif><a class="out" href="{{ route('agency.index') }}"><span>캠페인<br/>대행 의뢰</span></a></li>
		<li @if(Request::segment(2)=='edit_info')class="on"@endif><a class="out" href="{{ route('advertisers.edit_info') }}"><span>회원정보<br/>수정</span></a></li>
	</ul>
	<!-- //모바일 메뉴 -->