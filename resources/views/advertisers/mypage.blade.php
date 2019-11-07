@extends('layouts.main')
@section('content')

			@include('advertisers.advertiser_leftmenu')	
                        <!-- 오른쪽 컨텐츠 -->
			<div class="right-content">
                
				<p class="my-btn">
					<span><a href="{{ route('campaigns.create') }}" class="btn w50">새 캠페인 등록하기</a></span>
					<span><a href="#" class="btn w50 fl-r">캠페인 대행 의뢰하기</a></span>
				</p>

				<div class="my-campaign">
					<div class="title">	
						<h2>진행중인 캠페인</h2>
						<a href="{{ route('advertisers.mypage') }}" class="btn black">캠페인관리</a>
					</div>
					<!-- 검수중 -->
					<div class="my-campaign-in">
						<b>검수중  <span>{{$waitCampaigns->count()}}</span></b>
						<div class="campaign-banner" align="center">
                            @forelse ($waitCampaigns as $waitCampaign)
                            <div>
								<a href="{{ route('advertisers.managecampaign').'#waitCampaigns' }}">
									<b class="txt01">{{$waitCampaign->name}}</b>
								</a>
							</div>
                            @empty
                            <div>
								<a href="#">
									<b class="txt01">검수중인 캠페인이 없습니다</b>
								</a>
							</div>
                            @endforelse
						</div>
					</div>
					<!-- //검수중 -->
					<!-- 리뷰어 선정대기중 -->
					<div class="my-campaign-in">
						<b>리뷰어 선정대기중  <span>{{$recruitCampaigns->count()}}</span></b>
						<div class="campaign-banner" align="center">
                            @forelse ($recruitCampaigns as $recruitCampaign)
							<div>
								<a href="{{ route('advertisers.managecampaign').'#recruitCampaigns' }}">
									<b class="txt02">{{ $recruitCampaign->name }}</b>
									<p class="txt03">모집현황 <span>10</span> / {{ $recruitCampaign->recruit_number }}</p>
								</a>
							</div>
                            @empty
							<div>
								<a href="#">
									<b class="txt01">리뷰어 선정대기중인 캠페인이 없습니다</b>
								</a>
							</div>
                            @endforelse
						</div>
					</div>
					<!-- //리뷰어 선정대기중 -->
					<!-- 진행중 -->
					<div class="my-campaign-in">
						<b>진행중  <span>{{$submitCampaigns->count()}}</span></b>
						<div class="campaign-banner" align="center">
							@forelse ($submitCampaigns as $submitCampaign)
							<div>
								<a href="{{ route('advertisers.managecampaign').'#submitCampaigns' }}">
									<b class="txt02">{{ $submitCampaign->name }}</b>
									<p class="txt03">모집현황 <span>10</span> / {{ $submitCampaign->recruit_number }}</p>
								</a>
							</div>
                            @empty
							<div>
								<a href="#">
									<b class="txt01">진행중인 캠페인이 없습니다</b>
								</a>
							</div>
                            @endforelse
						</div>
					</div>
					<!-- //진행중 -->
					<!-- 완료 -->
					<div class="my-campaign-in">
						<b>완료  <span>{{$endCampaigns->count()}}</span></b>
						<div class="campaign-banner" align="center">
							@forelse ($endCampaigns as $endCampaign)
                            <div>
								<a href="{{ route('advertisers.managecampaign').'#endCampaigns' }}">
									<b class="txt01">{{$endCampaign->name}}</b>
								</a>
							</div>
                            @empty
                            <div>
								<a href="#">
									<b class="txt01">완료된 캠페인이 없습니다</b>
								</a>
							</div>
                            @endforelse
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

@include('advertisers.advertiser_leftmenu_tail')
<script type="text/javascript">	
	$('.campaign-banner').slick({
		infinite: true,
		arrows: true
	});
</script>	
@endsection