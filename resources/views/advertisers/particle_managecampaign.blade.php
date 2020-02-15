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
                    @if($type=='select')
    				<span style="margin-left:10px;" class="dday @if($campaign->rightNow===0) on @endif">D-@if($campaign->rightNow===0)
                        Day
                        @else
                        {{$campaign->rightNow}}
                        @endif</span>
                    @endif
    			</p>									
    			<p class="subject">{{$campaign->name}}</p>
    			<p class="subtxt">{{$campaign->offer_goods}} + {{number_format($campaign->offer_point)}} 포인트 지급 </p>
    		</div>
    		<div class="campaign-list-info-right">
<!--                선정대기중일때-->
                @if($type=='modi')
    			<a href="{{route('campaigns.edit',$campaign->id)}}" class="btn btn-check w125">캠페인 수정</a>
<!--                리뷰어모집중일때-->
                @elseif($type=='select')
                <p class="num">
                    <span class="title">모집현황</span>
                    <span class="txt"><b>{{$campaign->campaignReviewers->count()}}</b> / {{$campaign->recruit_number}}</span>
                </p>
                @if($campaign->campaignReviewers->count()>0)
                <a href="{{route('advertisers.recruit_campaign',$campaign->id)}}" class="btn btn-check w125">리뷰어 선정</a>
                @endif
<!--                진행중일때-->
                @elseif($type=='result')
                <p class="num">
                    <span class="title">리뷰제출</span>
                    <span class="txt"><b>{{$campaign->reviews_count}}</b> / {{$campaign->campaignReviewers->count()}}</span>
                </p>
                @if($campaign->reviews_count>0)
                <a href="{{route('advertisers.submit_campaign',$campaign->id)}}" class="btn btn-check w125">진행결과 보기</a>
                @endif
                @if($campaign->campaignReviewers->count()==0)
                @if($campaign->refund==null)
                <a href="{{route('advertisers.refund', $campaign->id)}}" class="btn btn-check w125">포인트환불</a>
                @else
                포인트환불완료
                @endif
                @endif
<!--                완료시점-->
                @elseif($type=='end')
                <p class="num">
                    <span class="title">리뷰제출</span>
                    <span class="txt"><b>{{$campaign->reviews_count}}</b> / {{$campaign->recruit_number}}</span>
                </p>
                @if($campaign->reviews_count>0)
                <a href="{{route('advertisers.submit_campaign',$campaign->id)}}" class="btn btn-check w125">진행결과 보기</a>
                @endif
                
                @if($campaign->reviews_count < $campaign->recruit_number)
                @if($campaign->refund==null)
                <a href="{{route('advertisers.refund', $campaign->id)}}" class="btn btn-check w125">포인트환불</a>
                @else
                포인트환불완료
                @endif
                @endif
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
<script>

</script>