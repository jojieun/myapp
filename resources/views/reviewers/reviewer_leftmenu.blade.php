<span class="m-bar2"></span>
	<!-- 모바일 마이페이지 -->
	<p class="m-top-title">
		<b class="name">{{$user->name}}님</b>
		<span>{{$user->email}}</span>
	</p>
	<!-- //모바일 마이페이지 -->
	<div class="sub-container bt-ddd w-pc-fixed">		

		<!-- 상세 컨텐츠내용 -->
		<div class="content-in-sub">
			<!-- 왼쪽메뉴 -->		
		  <div class="leftmenu">
		  	<p class="leftmenu-title">
		  		<b class="name">{{ $user->nickname }}님</b>
		  		<span>{{ $user->email }}</span>
		  	</p>
		  	<ul> 
		  		<li><a href="#"><span>나의 캠페인</span></a></li>
		  		<li><a href="#"><span>미제출 리뷰</span></a></li>
                @if($user->plan)
		  		<li @if(Request::segment(1)=='plans')class="on"@endif><a href="{{route('plans.showmy',$user->plan->id)}}"><span>나의 리뷰전략 관리</span></a></li>
                @else
                <li @if(Request::segment(1)=='plans')class="on"@endif><a href="{{route('plans.create')}}"><span>리뷰전략 등록하기</span></a></li>
                @endif
		  		<li><a href="#"><span>리뷰전략 열람 정보</span></a></li>
		  		<li><a href="#"><span>리뷰어 제안</span></a></li>
		  		<li><a href="#"><span>관심 캠페인</span></a></li>
		  		<li><a href="#"><span>나의 포인트</span></a></li>
		  		<li><a href="#"><span>회원정보수정</span></a></li>
		  		<li class="fw-500"><a href="#"><span>mySNS</span></a>
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
		  		</li>
		  	</ul>
		  </div>

                