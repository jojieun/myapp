<li>
    <? $locaOrCate = $campaign->form == 'v'?$campaign->region_name.' '.$campaign->area_name:$campaign->category_name;//위치 또는 카테고리 표시?>
    <div class="reviewer-list-thum">
        <img src="/files/{{$campaign->main_image}}" alt="">
    </div>
    <div class="reviewer-list-info">
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
        @if($option=='select')
                <span class="end-date">
                    리뷰제출 종료일
                    <em>{{$campaign->end_submit}}</em>
                </span>
                @endif
        
        <div class="campaign-list-info-right">
<!--                                        신청캠페인에서 출력-->
            @if($option=='apply')
            <a href="{{ route('campaigns.show', [$campaign->campaign_id, 'd'=>$campaign->rightNow, 'applyCount'=>$campaign->applyCount, 'locaOrCate'=>$locaOrCate]) }}" class="btn btn-check w125">캠페인보기</a>
            @else
            <a class="btn btn-check w80 chat_button" data-ad="{{$campaign->advertiser_id}}" data-re="{{auth()->user()->id}}">광고주채팅</a>
                @if($option=='select')
                <a href="{{ route('campaigns.show', [$campaign->campaign_id, 'd'=>$campaign->rightNow, 'applyCount'=>$campaign->applyCount, 'locaOrCate'=>$locaOrCate]) }}" class="btn btn-check w80">캠페인보기</a>
                    @if($campaign->take_visit_check==0)
                    <a href="#" class="btn btn-check w80 black take_visit" data-cri="{{$campaign->campaign_reviewers_id}}" data-type="{{$campaign->form}}">@if($campaign->form=='v')방문@else수취@endif확인</a>
                    @else
                        @if($campaign->review==null)
                        <a href="#popup_reviewer" class="btn btn-check w80 black submission" data-c="{{$campaign->campaign_id}}" data-cr="{{$campaign->id}}">리뷰제출</a>
                        @else
                        <a class="btn btn-check w80 edit_review" data-r="{{$campaign->review->id}}">리뷰수정</a>
                        @endif
                    @endif
                @else
                    @if($campaign->take_visit_check==0)
                    <a href="#" class="btn btn-check w125 black take_visit" data-cri="{{$campaign->id}}" data-type="{{$campaign->form}}">마감후 @if($campaign->form=='v')방문@else수취@endif확인</a>
                    @else
                        @if($campaign->review==null)
                        <a href="#popup_reviewer" class="btn btn-check w125 black submission" data-c="{{$campaign->campaign_id}}" data-cr="{{$campaign->id}}">마감후 리뷰제출</a>
                        @else
                        <a class="btn btn-check w125 edit_review" data-r="{{$campaign->review->id}}">마감후 리뷰수정</a>
                        @endif
                    @endif
<!--            <a href="#" class="btn btn-check w125">마감후 리뷰제출</a>-->
            @endif
        @endif
    </div>
</div>
</li>