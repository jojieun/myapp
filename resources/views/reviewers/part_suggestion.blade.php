<ul>
            @forelse($suggestions as $campaign)
			<li>
                <? $locaOrCate = $campaign->form == 'v'?$campaign->region_name.' '.$campaign->area_name:$campaign->category_name;//위치 또는 카테고리 표시?>
                <a href="{{ route('campaigns.show', [$campaign->id, 'd'=>$campaign->rightNow, 'applyCount'=>$campaign->applyCount, 'locaOrCate'=>$locaOrCate]) }}">
                    <div class="reviewer-list-thum">
                        <img src="/files/{{$campaign->main_image}}" alt="">
                    </div>
                </a>
				<div class="reviewer-list-info">
                    <a href="{{ route('campaigns.show', [$campaign->id, 'd'=>$campaign->rightNow, 'applyCount'=>$campaign->applyCount, 'locaOrCate'=>$locaOrCate]) }}">
                        <div class="list-info-top">
						<p class="tag-area">
							@if($campaign->form == 'v')
                            <span class="v">방문</span>
                            @else
                            <span class="h">재택</span>
                            @endif
                            <span class="bg-bl">
                                {{$locaOrCate}}
                            </span>
                            <span class="sns">
                                <span class="channel{{$campaign->channel_id}}">
                                    {{$campaign->channel_name}}
                                </span>
                            </span>
                            <span class="num">
                                <b>신청 {{$campaign->applyCount}}</b> / {{$campaign->recruit_number}}명
                            </span>
                            @if($option=='apply')
                            <span class="dday @if($campaign->rightNow==0) on @endif">
                                D-@if($campaign->rightNow==0)
                                Day
                                @else
                                {{$campaign->rightNow}}
                                @endif
                            </span>
                            @endif
                            </p>
                            <p class="subject">{{$campaign->name}}</p>
                            <p class="subtxt">
                                {{$campaign->offer_goods}} + {{number_format($campaign->offer_point)}} 포인트 지급
                            </p>
                        </div>
                    </a>
                    <div class="campaign-list-info-right btn-w50">
                        <a href="#" class="btn btn-check w125 mb5 no_accept" data-s="{{$campaign->suggestion_id}}">제안 거절</a>
                        <br/>
                        <a href="#popup_term" class="btn black btn-check w125 m-fl-r accept" data-s="{{$campaign->suggestion_id}}" data-c="{{$campaign->id}}">제안 수락</a>
                    </div>
                </div>
            </li>
            @empty
            <li>
                리뷰어 제안이 없습니다.
            </li>
            @endforelse
        </ul>