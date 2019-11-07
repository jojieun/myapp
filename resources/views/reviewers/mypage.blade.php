@extends('layouts.main')
@section('content')

			<!-- 왼쪽메뉴 -->
			@include('reviewers.reviewer_leftmenu')
						
			<!-- 오른쪽 컨텐츠 -->
			<div class="right-content">
				<div class="my-reviewer-top">
					<dl>
						<dt><b>나의포인트</b><a href="#">자세히보기</a></dt>
						<dd><b>{{ $user->point }}</b>P</dd>
					</dl>
					<ul>
						<li><span class="title">미제출리뷰</span><span class="txt"><b>0</b><em>건</em></span></li>
						<li><span class="title">리뷰제안</span><span class="txt"><b>0</b><em>건</em></span></li>
						<li><span class="title">리뷰전략열람</span><span class="txt"><b>0</b><em>건</em></span></li>
						<li><span class="title">관심캠페인</span><span class="txt"><b>0</b><em>건</em></span></li>
					</ul>
				</div>
                @if(!$user->plan_count)
				<p class="login-info2">
					<span class="txt">리뷰전략 등록으로 캠페인 리뷰어로 신청해보세요!</span>
					<a href="{{route('plans.create')}}" class="btn h46 fl-r">리뷰전략등록</a>
				</p>
				@endif
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
                            @forelse($applyCampaigns as $campaign)
                                @include('reviewers.particle_mycampaign')
                            @empty
                                신청캠페인이 없습니다
                            @endforelse
						</ul>
					</div>
				</div>				
				<!-- //캠페인 리스트 -->
			</div>
			<!-- //오른쪽 컨텐츠 -->
		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>
@include('reviewers.reviewer_bottommenu')
@endsection