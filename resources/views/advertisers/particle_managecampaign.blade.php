<ul>
                @forelse($campaigns as $campaign)
    <li>
    	<div class="campaign-list-info">
    		<div class="list-info-top">
    			<p class="tag-area">
                                @if($campaign->form == 'v')
    				<span class="v">방문</span>
                                @else
                                <span class="h">재택</span>
                                @endif
    				<span class="bg-bl">
                                    @if($campaign->region_name)
                                    {{$campaign->region_name.' '.$campaign->area_name}}
                                    @else
                                    {{$campaign->category_name}}
                                    @endif
                                </span>
    				<span class="sns"><span class="channel{{$campaign->channel_id}}">{{$campaign->channel_name}}</span></span>
                    @if($select)
    				<span style="margin-left:10px;" class="dday @if($campaign->rightNow=='Day') on @endif">D-{{$campaign->rightNow}}</span>
                    @endif
    			</p>									
    			<p class="subject">{{$campaign->name}}</p>
    			<p class="subtxt">{{$campaign->offer_goods}} + {{number_format($campaign->offer_point)}} 포인트 지급 </p>
    		</div>
    		<div class="campaign-list-info-right">
                @if($modi)
    			<a href="client_0202.php" class="btn btn-check w125">캠페인 수정</a>
                @endif
                @if($select)
                <p class="num">
                    <span class="title">모집현황</span>
                    <span class="txt"><b>5</b> / {{$campaign->recruit_number}}</span>
                </p>
                <a href="client_0204.php" class="btn btn-check w125">리뷰어 선정</a>
                @endif
                @if($result)
                <p class="num">
                    <span class="title">리뷰제출</span>
                    <span class="txt"><b>5</b> / {{$campaign->recruit_number}}</span>
                </p>
                <a href="client_0205.php" class="btn btn-check w125">진행결과 보기</a>
                @endif
    		</div>
    	</div>
    </li>
    @empty
    <li>
    	<div class="campaign-list-info">
            {{$which}} 캠페인이 없습니다
    	</div>
    </li>
                @endforelse
</ul>