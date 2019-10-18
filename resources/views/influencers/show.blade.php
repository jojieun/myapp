@extends('layouts.main')
@section('content')
<div class="sub-container bt-ddd">
		
		<section class="content-in-top2 mb80">
			<h2 class="m-ml3">인플루언서</h2>

			<div class="table_default influencer-view">
				<div class="table_th">
					<span class="title">사진 전공자가 만드는 고퀄리티 리뷰</span>
				</div>

				<!-- 광고주 로그인 -->
				<p class="login-info">
					<span class="txt">광고주 회원으로 로그인하시면 <b>모든 정보를 확인</b> 하실 수 있습니다.</span>
					<span class="fl-r">
						<a href="/member/login.php" class="btn black h46">로그인</a>
						<a href="/member/join_step1.php" class="btn h46">회원가입</a>
					</span>
				</p>
				<!-- //광고주 로그인 -->

				<div class="table_td">
					<div class="table_td_line">
						<div class="view-img">
							<img src="/img/sub/ico_influencer.gif" alt="">
						</div> 

						<div class="view-info">
							<dl>
								<dt>이름/닉네임</dt>
								<dd>조지은 / 조조</dd>
							</dl>
							<dl>
								<dt>연락처</dt>
								<dd>010-0000-0000
									<span class="tell-ok">통화가능시간 00:00~00:00</span>
								</dd>
							</dl>
							<dl>								
								<dt>이메일</dt>
								<dd>0000@naver.com</dd>	
							</dl>
							<dl>							
								<dt>SNS</dt>
								<dd class="sns">
									<span class="ico-blog"><a href="#">blog.naver.com/0000</a></span>
									<span class="ico-insta"><a href="#">Instagram.com/0000</a></span>
								</dd>	
							</dl>
							<dl>							
								<dt>주소</dt>
								<dd>경남 양산시 어쩌고 저쩌고 12-34 경남 양산시 어쩌고 저쩌고 12-34 경남 양산시 어쩌고 저쩌고 12-34 경남 양산시 어쩌고 저쩌고 12-34</dd>
							</dl>
						</div>
					</div>				
				</div>
				<div class="table_td">
					<div class="table_td_line">
						<div class="view-title">
							<h3>희망 캠페인 조건</h3>
						</div> 

						<div class="view-info">
							<dl>
								<dt>지역</dt>
								<dd>부산, 경남</dd>
							</dl>
							<dl>
								<dt>카테고리</dt>
								<dd>맛집, 문화, 기타</dd>
							</dl>
							<dl>								
								<dt>리워드</dt>
								<dd>50000P</dd>	
							</dl>
						</div>
					</div>				
				</div>

				<div class="table_td">
					<div class="table_td_line">
						<div class="view-title">
							<h3>리뷰전략</h3>
						</div>
						<div class="view-info">
							<p>리뷰어 경력 30년에 하루 방문자수 오천만을 자랑하는 이러쿵 저러쿵<br/>리뷰어 경력 30년에 하루 방문자수 오천만을 자랑하는 이러쿵 저러쿵<br/>리뷰어 경력 30년에 하루 방문자수 오천만을 자랑하는 이러쿵 저러쿵</p>
						</div>
					</div>				
				</div>

			</div>
			<!-- //table_default-->
			
			<div class="text-center">
				<a href="#" class="btn big2 black mtb50">리뷰제안</a>
			</div>

		</section>	
	</div>
@endsection