		<!-- 왼쪽메뉴 -->
		<div class="leftmenu">
			<p class="leftmenu-title">
				<b>CS Center</b>
				<span>고객센터</span>
			</p>
			<ul>
				<li><a href="{{route('onetoones.create')}}"><span>1:1 문의하기</span></a></li>
				<li class="on"><a href="{{route('reveiwer_faqs.index')}}"><span>FAQ</span></a>
					<ul>							
						<li class="on"><a href="{{route('reveiwer_faqs.index')}}">리뷰어</a></li>
						<li><a href="{{route('advertiser_faqs.index')}}">광고주</a></li>
					</ul>
				</li>
				<li><a href="{{route('notices.index')}}"><span>공지사항</span></a></li>
				<li><a href="{{route('onetoones.index')}}"><span>나의문의내역</span></a></li>
			</ul>
		</div>