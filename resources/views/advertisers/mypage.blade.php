@extends('layouts.main')
@section('content')

			@include('layouts.advertiser_leftmenu')	
                        <!-- 오른쪽 컨텐츠 -->
			<div class="right-content">
				<p class="my-btn">
					<span><a href="{{ route('campaigns.create') }}" class="btn w50">새 캠페인 등록하기</a></span>
					<span><a href="#" class="btn w50 fl-r">캠페인 대행 의뢰하기</a></span>
				</p>

				<div class="my-campaign">
					<div class="title">	
						<h2>진행중인 캠페인</h2>
						<a href="client_0201.php" class="btn black">캠페인관리</a>
					</div>
					<!-- 검수중 -->
					<div class="my-campaign-in">
						<b>검수중  <span>1</span></b>
						<div class="campaign-banner" align="center">
							<div>
								<a href="#">
									<b class="txt01">닭장수후라이드 목동점 닭장수후라이드 목동점 1</b>
								</a>
							</div>
							<div>
								<a href="#">
									<b class="txt01">닭장수후라이드 목동점 2</b>
								</a>
							</div>
							<div>
								<a href="#">
									<b class="txt01">닭장수후라이드 목동점 3</b>
								</a>
							</div>
							<div>
								<a href="#">
									<b class="txt01">닭장수후라이드 목동점 4</b>
								</a>
							</div>
						</div>
					</div>
					<!-- //검수중 -->
					<!-- 리뷰어 선정대기중 -->
					<div class="my-campaign-in">
						<b>리뷰어 선정대기중  <span>1</span></b>
						<div class="campaign-banner" align="center">
							<div>
								<a href="#">
									<b class="txt02">에스쁘아 멋진 상품 에스쁘아 멋진 상품 에스쁘아 멋진 상품 1</b>
									<p class="txt03">모집현황 <span>10</span> / 5</p>
								</a>
							</div>
							<div>
								<a href="#">
									<b class="txt02">에스쁘아 멋진 상품 에스쁘아 멋진 상품 에스쁘아 멋진 상품 2</b>
									<p class="txt03">모집현황 <span>10</span> / 5</p>
								</a>
							</div>
							<div>
								<a href="#">
									<b class="txt02">에스쁘아 멋진 상품 에스쁘아 멋진 상품 에스쁘아 멋진 상품 3</b>
									<p class="txt03">모집현황 <span>10</span> / 5</p>
								</a>
							</div>
							<div>
								<a href="#">
									<b class="txt02">에스쁘아 멋진 상품 에스쁘아 멋진 상품 에스쁘아 멋진 상품 4</b>
									<p class="txt03">모집현황 <span>10</span> / 5</p>
								</a>
							</div>
						</div>
					</div>
					<!-- //리뷰어 선정대기중 -->
					<!-- 진행중 -->
					<div class="my-campaign-in">
						<b>진행중  <span>1</span></b>
						<div class="campaign-banner" align="center">
							<div>
								<a href="#">
									<b class="txt02">내가 최고야 스킨케어 1</b>
									<p class="txt03">리뷰제출 <span>10</span> / 5</p>
								</a>
							</div>
							<div>
								<a href="#">
									<b class="txt02">내가 최고야 스킨케어 2</b>
									<p class="txt03">리뷰제출 <span>10</span> / 5</p>
								</a>
							</div>
							<div>
								<a href="#">
									<b class="txt02">내가 최고야 스킨케어 3</b>
									<p class="txt03">리뷰제출 <span>10</span> / 5</p>
								</a>
							</div>
							<div>
								<a href="#">
									<b class="txt02">내가 최고야 스킨케어 4</b>
									<p class="txt03">리뷰제출 <span>10</span> / 5</p>
								</a>
							</div>
						</div>
					</div>
					<!-- //진행중 -->
					<!-- 완료 -->
					<div class="my-campaign-in">
						<b>완료  <span>1</span></b>
						<div class="campaign-banner" align="center">
							<div>
								<a href="#">
									<b class="txt01">닭장수후라이드 목동점 1</b>
								</a>
							</div>
							<div>
								<a href="#">
									<b class="txt01">닭장수후라이드 목동점 2</b>
								</a>
							</div>
							<div>
								<a href="#">
									<b class="txt01">닭장수후라이드 목동점 3</b>
								</a>
							</div>
							<div>
								<a href="#">
									<b class="txt01">닭장수후라이드 목동점 4</b>
								</a>
							</div>
						</div>
					</div>
					<!-- //완료 -->
				</div>

				<p class="my-btn-bottom">
					<span><a href="#">인플루언서 검색</a></span>
					<span><a href="client_0501.php">회원정보수정</a></span>
				</p>
                             </div>
			<!-- //오른쪽 컨텐츠 -->

@include('layouts.advertiser_leftmenu_tail')
<script type="text/javascript">	
	$('.campaign-banner').slick({
		infinite: true,
		arrows: true
	});
</script>	
@endsection