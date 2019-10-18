@extends('layouts.main')
@section('content')
<div class="sub-container">

		<ul class="campaign_tab">
			<li class="on"><a href="#"><span>캠페인</span><span>개요</span></a></li>
			<li><a href="#campaign01"><span>상세</span><span>이미지</span></a></li>
			<li><a href="#campaign02"><span>리뷰</span><span>미션</span></a></li>
			<li><a href="#campaign03"><span>리뷰</span><span>키워드</span></a></li>
			<li><a href="#campaign04"><span>방문</span><span>안내</span></a></li>
			<li><a href="#campaign05"><span>기타</span><span>사항</span></a></li>
		</ul>
	
		<!-- 캠페인 개요 -->
		<section class="bg-gray">
			<div class="content-in-sub-top pt2 mt120">
				<div class="campaign-detail-img">
					<img src="/img/sub/img_detail.jpg" alt="">
				</div> 

				<div class="campaign-detail-info">
					<div class="detail-info-top ">
						<p class="tag-area">
							<span class="type01">방문</span>
							<span class="bg-bl">동탄 목동</span>
							<span class="sns"><span class="insta">인스타그램</span></span>
						</p>
						<p class="tag-area-right">
							<span class="num"><b>신청 22</b> / 10명</span>
							<span class="dday">D-11</span>
						</p>
						<h3>[동탄]닭장수후라이드 목동점 [동탄]닭장수후라이드 목동점</h3>
						<dl class="detail-info">
							<dt>제공내역</dt>
							<dd>
								3만원 식사권 지급 + 5,000 포인트 지급 - 추가금 발생시 본인부담, 현장결제입니다. - 남은 금액은 환불되지 않습니다.<br/>
								- 추가금 발생시 본인부담, 현장결제입니다.
							</dd>
						</dl>
						<p class="btn-share"><a href="#"><img src="/img/common/ico_share.gif" alt="공유하기"></a></p>
					</div>
					<dl class="detail-info">
						<dt>캠페인일정</dt>
						<dd>
							<p><span class="detail-title">리뷰어 신청기간</span><span><b>07.15 ~ 07.21</b></span></p>
							<p><span class="detail-title">리뷰어 발표</span><span>07.22</span></p>
							<p><span class="detail-title">리뷰 등록기간</span><span>07.23 ~ 07.31</span></p>
							<p><span class="detail-title">캠페인 결과발표</span><span>08.06</span></p>
						</dd>
					</dl>
					<span class="detail-btn">
						<a href="#" class="btn black big">신청하기</a>
						<a href="#" class="btn gray">관심캠페인</a>
					</span>
				</div>
			</div>
		</section>	
		<!-- //캠페인 개요 -->

		<span class="m-bar"></span>

		<!-- 캠페인 내용 -->
		<section class="content-in-sub">			
			<!-- 우측메뉴 -->
			<div id="navbar" class="campaign-detail-navi">
				<ul>
					<li class="on"><a href="#">캠페인개요</a></li>
					<li><a href="#campaign01">상세이미지</a></li>
					<li><a href="#campaign02">리뷰미션</a></li>
					<li><a href="#campaign03">리뷰키워드</a></li>
					<li><a href="#campaign04">방문안내</a></li>
					<li><a href="#campaign05">기타사항</a></li>
				</ul>
				<a href="#" class="btn black">신청하기</a>
			</div>
			<!-- //우측메뉴 -->
			<div class="campaign-detail-txt">
				<div id="campaign01">
					<img src="/img/sub/img_detail2.jpg" alt="상세이미지영역">
				</div>
				<dl id="campaign02" class="detail-txt">
					<dt>리뷰미션</dt>
					<dd>
						동탄목동치킨 키워드를 제목 맨 앞에 넣어주세요<br/>
						ex) 동탄목동치킨 가성비좋은 닭장수 후라이드 본문에 동탄목동치킨 키워드를 3번이상 사용해주세요<br/>
						메뉴사진+매장 내 외부사진 + 메뉴판 사진 등 사진 5장이상 첨부해주세요 짤막한 동영상도 넣어주시면 감사하겠습니다.<br/>
						* https://blog.naver.com/dakjangsu78 공식블로그 이웃 추가 해주시면 <br/>
						다양한 정보를 받아보실수 있으시고.... 무한 감사드리고^^;;; <br/>
						인스타도 하신다면 센스있게 올려주시면 더욱 감사하겠죵 ㅎㅎㅎ <br/>
						하단 매장지도 첨부 부탁드립니다.
					</dd>
				</dl>
				<dl id="campaign03" class="detail-txt">
					<dt>리뷰키워드</dt>
					<dd>#동탄맛집 #동탄목동맛집 #동탄치킨 #동탄목동치킨 #동탄2치킨집</dd>
				</dl>
				<dl id="campaign04" class="detail-txt">
					<dt>방문안내</dt>
					<dd>
						<p class="map">
							<img src="/img/sub/img_map.jpg" alt="지도영역">
						</p>
						<p>
							11:30~22:00 / 토, 일 방문 불가<br/>
							＊ 체험기간(7/23-7/31)이 짧은 캠페인입니다. 기간 내 체험이 가능하신 분들만 신청해주세요.<br/>
							＊ 1일 전 예약 필수 / 당일 예약 불가 / 예약없이 방문 시 체험불가
						</p>
					</dd>
				</dl>
				<dl id="campaign05" class="detail-txt">
					<dt>기타사항</dt>
					<dd>초과비용 본인 부담 / 타쿠폰 중복적용 불가 / 핸드폰카메라 촬영불가 / 테이크 아웃 불가</dd>
				</dl>
			</div>
		</section>
		<!-- //캠페인 내용 -->

		<!-- 추천 캠페인 -->
		<section class="bg-gray2">
			<div class="content-in-sub mt7b4">
				<h3>추천 캠페인</h3>
				<div class="campaign-list w5">
					<ul>					
						<li>
							<div class="campaign-item">
								<a href="#">
								<div class="thum">
									<img src="/img/main/img_thumb.jpg" alt="플래티넘 캠페인 이미지">
								</div>
								<div class="info">
									<span class="ico-tag">
										<span class="type01">방문</span>
										<span class="bg-bl">뷰티</span>
										<span class="dday">D-11</span>
									</span>
									<div class="txt-box">
										<p class="txt-top">
											<span class="sns"><span class="insta">인스타그램</span></span>
											<span class="num">10명 모집</span>
										</p>
										<span class="subject">[휴랩] 마르지 않는 물걸레 청소기</span>
										<span class="subtxt">아르투아 산토리니 폼클렌저 제공</span>							
									</div>
								</div>
								</a>
							</div>
						</li>
						<li>
							<div class="campaign-item">
								<a href="#">
								<div class="thum">
									<img src="/img/main/img_thumb.jpg" alt="플래티넘 캠페인 이미지">
								</div>
								<div class="info">
									<span class="ico-tag">
										<span class="type01">방문</span>
										<span class="bg-bl">뷰티</span>
										<span class="dday">D-11</span>
									</span>
									<div class="txt-box">
										<p class="txt-top">
											<span class="sns"><span class="insta">인스타그램</span></span>
											<span class="num">10명 모집</span>
										</p>
										<span class="subject">[휴랩] 마르지 않는 물걸레 청소기</span>
										<span class="subtxt">아르투아 산토리니 폼클렌저 제공</span>							
									</div>
								</div>
								</a>
							</div>
						</li>
						<li>
							<div class="campaign-item">
								<a href="#">
								<div class="thum">
									<img src="/img/main/img_thumb.jpg" alt="플래티넘 캠페인 이미지">
								</div>
								<div class="info">
									<span class="ico-tag">
										<span class="type01">방문</span>
										<span class="bg-bl">뷰티</span>
										<span class="dday">D-11</span>
									</span>
									<div class="txt-box">
										<p class="txt-top">
											<span class="sns"><span class="blog">네이버블로그</span></span>
											<span class="num">10명 모집</span>
										</p>
										<span class="subject">[휴랩] 마르지 않는 물걸레 청소기</span>
										<span class="subtxt">아르투아 산토리니 폼클렌저 제공</span>							
									</div>
								</div>
								</a>
							</div>
						</li>
						<li>
							<div class="campaign-item">
								<a href="#">
								<div class="thum">
									<img src="/img/main/img_thumb.jpg" alt="플래티넘 캠페인 이미지">
								</div>
								<div class="info">
									<span class="ico-tag">
										<span class="type01">방문</span>
										<span class="bg-bl">뷰티</span>
										<span class="dday">D-11</span>
									</span>
									<div class="txt-box">
										<p class="txt-top">
											<span class="sns"><span class="blog">네이버블로그</span></span>
											<span class="num">10명 모집</span>
										</p>
										<span class="subject">[휴랩] 마르지 않는 물걸레 청소기</span>
										<span class="subtxt">아르투아 산토리니 폼클렌저 제공</span>							
									</div>
								</div>
								</a>
							</div>
						</li>
						<li>
							<div class="campaign-item">
								<a href="#">
								<div class="thum">
									<img src="/img/main/img_thumb.jpg" alt="플래티넘 캠페인 이미지">
								</div>
								<div class="info">
									<span class="ico-tag">
										<span class="type01">방문</span>
										<span class="bg-bl">뷰티</span>
										<span class="dday">D-11</span>
									</span>
									<div class="txt-box">
										<p class="txt-top">
											<span class="sns"><span class="blog">네이버블로그</span></span>
											<span class="num">10명 모집</span>
										</p>
										<span class="subject">[휴랩] 마르지 않는 물걸레 청소기</span>
										<span class="subtxt">아르투아 산토리니 폼클렌저 제공</span>							
									</div>
								</div>
								</a>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</section>
		<!-- //추천 캠페인 -->
	</div>
@endsection