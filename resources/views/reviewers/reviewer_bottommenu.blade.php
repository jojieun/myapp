	<!-- 모바일 메뉴 -->
	<ul class="campaign_tab2">
		<li><a href="reviewer_0101.php"><span>나의<br/>캠페인</span></a></li>
		<li><a href="reviewer_0201.php"><span>미제출<br/>리뷰</span></a></li>
		<li><a href="reviewer_0301.php"><span>나의 리뷰<br/>전략 관리</span></a></li>
		<li><a href="reviewer_0401.php"><span>리뷰전략<br/>열람 정보</span></a></li>
		<li><a href="reviewer_0501.php"><span>리뷰어<br/>제안</span></a></li>
		<li><a href="reviewer_0601.php"><span>관심<br/>캠페인</span></a></li>
		<li><a href="reviewer_0701.php"><span>나의<br/>포인트</span></a></li>
		<li><a href="reviewer_0801.php"><span>회원정보<br/>수정</span></a></li>
		<li class="fw-500 on">
			<a href="reviewer_0901.php">
				<span>mySNS</span>
				<p class="sns">
					<span class="ico-blog @if(!$user->naver_blog) off @endif"></span>
		              <span class="ico-post @if(!$user->naver_post) off @endif"></span>
		              <span class="ico-facebook @if(!$user->facebook) off @endif"></span>
		              <span class="ico-insta @if(!$user->instagram) off @endif"></span>
		              <span class="ico-kakao @if(!$user->kakao) off @endif"></span>
		              <span class="ico-youtube @if(!$user->youtube) off @endif"></span>
				</p>
			</a>
		</li>
	</ul>
	<!-- //모바일 메뉴 -->