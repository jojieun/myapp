@extends('layouts.main')
@section('content')

			<!-- 왼쪽메뉴 -->
			@include('layouts.reviewer_leftmenu')
						
			<!-- 오른쪽 컨텐츠 -->
			<div class="right-content">
				<div class="my-reviewer-top">
					<dl>
						<dt><b>나의포인트</b><a href="#">자세히보기</a></dt>
						<dd><b>{{ $user->point }}</b>P</dd>
					</dl>
					<ul>
						<li><span class="title">미제출리뷰</span><span class="txt"><b>1</b><em>건</em></span></li>
						<li><span class="title">리뷰제안</span><span class="txt"><b>2</b><em>건</em></span></li>
						<li><span class="title">리뷰전략열람</span><span class="txt"><b>5</b><em>건</em></span></li>
						<li><span class="title">관심캠페인</span><span class="txt"><b>999</b><em>건</em></span></li>
					</ul>
				</div>

				<p class="login-info2">
					<span class="txt">리뷰전략 등록으로 캠페인 리뷰어로 신청해보세요!</span>
					<a href="#" class="btn h46 fl-r">리뷰전략등록</a>
				</p>
				
				<!-- 캠페인 리스트 -->
				<div>
					<!-- 탭 -->
					<ul class="mypage-tab">
						<li><a href="#" class="on">신청캠페인</a></li>
						<li><a href="#">선정캠페인</a></li>
						<li><a href="#">종료캠페인</a></li>
					</ul>
					<!-- //탭 -->
					<div class="my-reviewer">
						<ul>
							<li>
								<div class="reviewer-list-thum">
									<img src="/img/sub/img_detail.jpg" alt="">
								</div>
								<div class="reviewer-list-info">
									<div class="list-info-top">
										<p class="tag-area">
											<span class="type01">방문</span>
											<span class="bg-bl">동탄 목동</span>
											<span class="sns"><span class="insta">인스타그램</span></span>
											<span class="num"><b>신청 22</b> / 10명</span>
											<span class="dday">D-11</span>
										</p>									
										<p class="subject">[동탄]닭장수후라이드 목동점</p>
										<p class="subtxt">3만원 식사권 지급 + 5,000 포인트 지급 </p>
									</div>
									<div class="campaign-list-info-right">
										<a href="#" class="btn btn-check w125 black">리뷰제출</a>
									</div>
								</div>
							</li>
							<li>
								<div class="reviewer-list-thum">
									<img src="/img/sub/img_detail.jpg" alt="">
								</div>
								<div class="reviewer-list-info">
									<div class="list-info-top">
										<p class="tag-area">
											<span class="type01">방문</span>
											<span class="bg-bl">동탄 목동</span>
											<span class="sns"><span class="insta">인스타그램</span></span>
											<span class="num"><b>신청 22</b> / 10명</span>
											<span class="dday">D-11</span>
										</p>									
										<p class="subject">[동탄]닭장수후라이드 목동점</p>
										<p class="subtxt">3만원 식사권 지급 + 5,000 포인트 지급 </p>
									</div>
									<div class="campaign-list-info-right">
										<a href="#" class="btn btn-check w125">리뷰보기</a>
									</div>
								</div>
							</li>
							<li>
								<div class="reviewer-list-thum">
									<img src="/img/sub/img_detail.jpg" alt="">
								</div>
								<div class="reviewer-list-info">
									<div class="list-info-top">
										<p class="tag-area">
											<span class="type01">방문</span>
											<span class="bg-bl">동탄 목동</span>
											<span class="sns"><span class="insta">인스타그램</span></span>
											<span class="num"><b>신청 22</b> / 10명</span>
											<span class="dday">D-11</span>
										</p>									
										<p class="subject">[동탄]닭장수후라이드 목동점</p>
										<p class="subtxt">3만원 식사권 지급 + 5,000 포인트 지급 </p>
									</div>
									<div class="campaign-list-info-right">
										<a href="#" class="btn btn-check w125 black">리뷰제출</a>
									</div>
								</div>
							</li>
							<li>
								<div class="reviewer-list-thum">
									<img src="/img/sub/img_detail.jpg" alt="">
								</div>
								<div class="reviewer-list-info">
									<div class="list-info-top">
										<p class="tag-area">
											<span class="type01">방문</span>
											<span class="bg-bl">동탄 목동</span>
											<span class="sns"><span class="insta">인스타그램</span></span>
											<span class="num"><b>신청 22</b> / 10명</span>
											<span class="dday">D-11</span>
										</p>									
										<p class="subject">[동탄]닭장수후라이드 목동점</p>
										<p class="subtxt">3만원 식사권 지급 + 5,000 포인트 지급 </p>
									</div>
									<div class="campaign-list-info-right">
										<a href="#" class="btn btn-check w125">리뷰보기</a>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>				
				<!-- //캠페인 리스트 -->
			</div>
			<!-- //오른쪽 컨텐츠 -->
		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>
@endsection