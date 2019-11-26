		<!-- 왼쪽메뉴 -->
		<div class="leftmenu">
			<p class="leftmenu-title">
				<b>CS Center</b>
				<span>고객센터</span>
			</p>
			<ul>
				<li @if(Request::segment(1)=='onetoones' && Request::segment(2)=='create')class="on"@endif><a href="{{route('onetoones.create')}}"><span>1:1 문의하기</span></a></li>
				<li @if(Request::segment(1)=='reviewer_faqs' || Request::segment(1)=='advertiser_faqs')class="on"@endif><a href="{{route('reviewer_faqs.index')}}"><span>FAQ</span></a>
					<ul>							
						<li @if(Request::segment(1)=='reviewer_faqs')class="on"@endif><a href="{{route('reviewer_faqs.index')}}">리뷰어</a></li>
						<li @if(Request::segment(1)=='advertiser_faqs')class="on"@endif><a href="{{route('advertiser_faqs.index')}}">광고주</a></li>
					</ul>
				</li>
				<li @if(Request::segment(1)=='notices')class="on"@endif><a href="{{route('notices.index')}}"><span>공지사항</span></a></li>
				<li @if(Request::segment(1)=='onetoones' && Request::segment(2)==null)class="on"@endif><a href="{{route('onetoones.index')}}"><span>나의문의내역</span></a></li>
			</ul>
		</div>