		<!-- 왼쪽메뉴 -->
		<div class="leftmenu">
			<p class="leftmenu-title">
				<b>CS Center</b>
				<span>고객센터</span>
			</p>
			<ul>
				<li><a href="{{route('ask')}}"><span>1:1 문의하기</span></a></li>
				<li class="on"><a href="{{route('faq')}}"><span>FAQ</span></a>
					<ul>							
						<li class="on"><a href="{{route('faq')}}">리뷰어</a></li>
						<li><a href="{{route('faq')}}">광고주</a></li>
					</ul>
				</li>
				<li><a href="{{route('notice')}}"><span>공지사항</span></a></li>
				<li><a href="{{route('ask_list')}}"><span>문의내역</span></a></li>
			</ul>
		</div>