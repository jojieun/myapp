@extends('layouts.main')
@section('content')

			<!-- 왼쪽메뉴 -->
			@include('reviewers.reviewer_leftmenu')
						
			<!-- 오른쪽 컨텐츠 -->
			<div class="right-content">
				<div class="my-reviewer-top">
					<dl>
						<dt><b>나의포인트</b><a href="{{route('reviewers.point')}}">자세히보기</a></dt>
						<dd><b>{{ number_format($user->point) }}</b>P</dd>
					</dl>
					<ul>
						<li>
                            <a href="{{route('reviewers.not_submit')}}">
                            <span class="title">미제출리뷰</span><span class="txt"><b>{{$notreview}}</b><em>건</em></span>
                            </a>
                        </li>
						<li>
                            <a href="{{route('reviewers.suggestion')}}">
                            <span class="title">리뷰제안</span><span class="txt"><b>{{$suggestions}}</b><em>건</em></span></a></li>
<!--
						<li>
                            <a href="{{route('reviewers.plan_reading')}}">
                            <span class="title">리뷰전략열람</span><span class="txt"><b>{{$advertiserPlans}}</b><em>건</em></span></a></li>
-->
						<li>
                            <a href="{{route('reviewers.bookmark_list')}}">
                            <span class="title">관심캠페인</span><span class="txt"><b>{{$bookmarks}}</b><em>건</em></span></a></li>
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
						<li><a href="#apply" class="on">신청캠페인</a></li>
						<li><a href="#select">선정캠페인</a></li>
						<li><a href="#end">종료캠페인</a></li>
					</ul>
					<!-- //탭 -->
<!--                    신청캠페인-->
					<div class="my-reviewer" id="apply">
						<ul>
                            <? $option = 'apply'; //신청캠페인  ?>
                            @forelse($applyCampaigns as $campaign)
                                @include('reviewers.particle_mycampaign')
                            @empty
                                모집중인 신청캠페인이 없습니다
                            @endforelse
						</ul>
					</div>
<!--                    선정캠페인-->
                    <div class="my-reviewer" id="select">
						<ul>
                            <? $option = 'select'; //선정캠페인 표시  ?>
                            @forelse($selectCampaigns as $campaign)
                                @include('reviewers.particle_mycampaign')
                            @empty
                                선정된 캠페인이 없습니다
                            @endforelse
						</ul>
					</div>
<!--                    종료캠페인-->
                    <div class="my-reviewer" id="end">
						<ul>
                            <? $option = 'end'; //종료캠페인 표시  ?>
                            @forelse($endCampaigns as $campaign)
                                @include('reviewers.particle_mycampaign')
                            @empty
                                종료된 참여 캠페인이 없습니다
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
<!--리뷰작성-->
@include('reviewers.make_review')
<!--리뷰수정-->
@include('reviewers.edit_review')
@include('reviewers.mycampaign_script')
@endsection