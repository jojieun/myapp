	<!-- 모바일 메뉴 -->
	<ul class="campaign_tab2 reviewermenu">
		<li @if(Request::segment(2)=='my_campaign')class="on"@endif><a class="out" href="{{route('reviewers.my_campaign')}}"><span>나의<br/>캠페인</span></a></li>
		<li @if(Request::segment(2)=='not_submit')class="on"@endif><a class="out" href="{{route('reviewers.not_submit')}}"><span>미제출<br/>리뷰</span></a></li>
        @if($user->plan)
		<li @if(Request::segment(1)=='plans')class="on"@endif><a class="out" href="{{route('plans.showmy',$user->plan->id)}}"><span>나의 리뷰<br/>전략 관리</span></a></li>
        @else
        <li @if(Request::segment(1)=='plans')class="on"@endif><a href="{{route('plans.create')}}" class="out"><span>리뷰전략 등록하기</span></a></li>
        @endif
		<li @if(Request::segment(2)=='plan_reading')class="on"@endif><a class="out" href="{{route('reviewers.plan_reading')}}"><span>리뷰전략<br/>열람 정보</span></a></li>
		<li @if(Request::segment(2)=='suggestion')class="on"@endif><a class="out" href="{{route('reviewers.suggestion')}}"><span>리뷰어<br/>제안</span></a></li>
		<li><a class="out" href="#"><span>관심<br/>캠페인</span></a></li>
		<li><a class="out" href="#"><span>나의<br/>포인트</span></a></li>
		<li><a class="out" href="#"><span>회원정보<br/>수정</span></a></li>
		<li class="fw-500 on">
			<div class="out">
				<span id="sns_title">mySNS</span>
				<p class="sns">
					@foreach($chls as $chl)
                         @if($val=$user->channelreviewers->where('channel_id',$chl->id)->first())
                        <a href="{{$chl->url}}{{$val->name}}" target="_blank">
		  				<span class="ico-{{$chl->id}}"></span>
                        </a>
                        @else
                        <span class="ico-{{$chl->id}} off"></span>
                        @endif
                    @endforeach
				</p>
			</div>
		</li>
	</ul>
	<!-- //모바일 메뉴 -->