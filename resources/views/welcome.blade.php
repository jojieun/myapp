@extends('layouts.main')

@section('content')
<!-- 메인배너 -->
	<div class="main-banner m-t60" align="center">
        @foreach($main_banners as $main_banner)
        <a href="{{$main_banner->url}}"><img src="/files/banner/{{$main_banner->name}}" alt=""></a>
        @endforeach
	</div>
	<!-- //메인배너 -->

	<!-- 메인 컨텐츠 -->
	<div class="m-bg-f4">
		<!-- 플래티넘 캠페인 -->
		<section class="content-in">
			<h2>플래티넘 캠페인</h2>
			<div class="campaign-list">
				<ul>
                    <? $campaigns = $plCampaigns ?>
                    @include('campaigns.part_campaign', ['empty_msg' => '플래티넘 캠페인을 등록해보세요!'])
				</ul>
			</div>
		</section>		
		<!-- //플래티넘 캠페인 -->

		<!-- 중단 배너 -->
		<div class="main-banner" align="center">
            @foreach($middle_banners as $middle_banner)
        <a href="{{$middle_banner->url}}"><img src="/files/banner//{{$middle_banner->name}}" alt=""></a>
        @endforeach
		</div>	
		<!-- 중단 배너 -->

		<!-- 프라임 캠페인 -->
		<section class="content-in">
			<h2>프라임 캠페인</h2>
			<div class="campaign-list w5">
				<ul>
                    <? $campaigns = $prCampaigns ?>
                    @include('campaigns.part_campaign', ['empty_msg' => '프라임 캠페인을 등록해보세요!'])
				</ul>
			</div>
		</section>		
		<!-- //프라임 캠페인 -->

		<!-- 하단 배너 -->
		<div class="main-banner" align="center">
			@foreach($bottom_banners as $bottom_banner)
        <a href="{{$bottom_banner->url}}"><img src="/files/banner/{{$bottom_banner->name}}" alt=""></a>
        @endforeach
		</div>	
		<!-- //하단 배너 -->

		<!-- 그랜드 캠페인 -->
		<section class="content-in">
			<h2>그랜드 캠페인</h2>
			<div class="campaign-list w6">
				<ul>
                    <? $campaigns = $gCampaigns ?>
                    @include('campaigns.part_campaign', ['empty_msg' => '그랜드 캠페인을 등록해보세요!'])
				</ul>
			</div>
<!--            일반캠페인-->
            <div class="campaign-list w6">
				<ul>
                    <? $campaigns = $nCampaigns ?>
                    @include('campaigns.part_campaign', ['empty_msg' => ''])
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
        arrows: true,
        responsive: [ { /* 반응형웹*/ breakpoint: 700, /* 기준화면사이즈 */ settings: {arrows: false } /* 사이즈에 적용될 설정 */ },]
	});
</script>	

@endsection