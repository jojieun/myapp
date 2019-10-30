@extends('layouts.main')

@section('content')
<!-- 메인배너 -->
	<div class="main-banner m-t60" align="center">
		<div><img src="/img/main/main_slide01.jpg" alt=""></div>
		<div><img src="/img/main/main_slide01.jpg" alt=""></div>
		<div><img src="/img/main/main_slide01.jpg" alt=""></div>
		<div><img src="/img/main/main_slide01.jpg" alt=""></div>
	</div>
	<!-- //메인배너 -->

	<!-- 메인 컨텐츠 -->
	<div class="m-bg-f4">
		<!-- 플래티넘 캠페인 -->
		<section class="content-in">
			<h2>플래티넘 캠페인</h2>
			<div class="campaign-list">
				<ul>
                    @forelse($plCampaigns as $campaign)
					@include('campaigns.campaign')
                    @empty
                        <div>플래티넘 캠페인을 등록해보세요!</div>
                    @endforelse
				</ul>
			</div>
		</section>		
		<!-- //플래티넘 캠페인 -->

		<!-- 중단 배너 -->
		<div class="main-banner" align="center">
			<div><img src="/img/main/banner.jpg" alt=""></div>
			<div><img src="/img/main/banner.jpg" alt=""></div>
			<div><img src="/img/main/banner.jpg" alt=""></div>
			<div><img src="/img/main/banner.jpg" alt=""></div>
		</div>	
		<!-- 중단 배너 -->

		<!-- 프라임 캠페인 -->
		<section class="content-in">
			<h2>프라임 캠페인</h2>
			<div class="campaign-list w5">
				<ul>
                   @forelse($prCampaigns as $campaign)
					@include('campaigns.campaign')
                    @empty
                        <div>프라임 캠페인을 등록해보세요!</div>
                    @endforelse
				</ul>
			</div>
		</section>		
		<!-- //프라임 캠페인 -->

		<!-- 중단 배너2 -->
		<div class="main-banner" align="center">
			<div><img src="/img/main/banner.jpg" alt=""></div>
			<div><img src="/img/main/banner.jpg" alt=""></div>
			<div><img src="/img/main/banner.jpg" alt=""></div>
			<div><img src="/img/main/banner.jpg" alt=""></div>
		</div>	
		<!-- 중단 배너2 -->

		<!-- 그랜드 캠페인 -->
		<section class="content-in">
			<h2>그랜드 캠페인</h2>
			<div class="campaign-list w6">
				<ul>
                   @forelse($gCampaigns as $campaign)
					@include('campaigns.campaign')
                    @empty
                        <div>그랜드 캠페인을 등록해보세요!</div>
                    @endforelse
				</ul>
			</div>
		</section>		
		<!-- //그랜드 캠페인 -->
	</div>
	
<script type="text/javascript">	
	$('.main-banner').slick({
		dots: true,
		infinite: true,
		autoplay: true,
		autoplaySpeed: 2500,
	});
</script>	

@endsection