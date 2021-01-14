<ul class="reviewer-th take_visit">
	<li>NO</li>
	<li>닉네임</li>
	<li>성별</li>
	<li>나이</li>
	<li>지역</li>
	<li>리뷰전략</li>
	<li>@if($campaign->form == 'v')방문@else배송@endif현황</li>
    <li>리뷰제출현황</li>
	<li>1:1채팅</li>
</ul>
<ul class="reviewer-td take_visit">
    @forelse($campaignreviewers as $campaignreviewer)
    <li>
		<span class="bar">{{ $loop->iteration }}</span>
		<span class="bar">{{$campaignreviewer->reviewer->nickname}}</span>
		<span class="bar">@if($campaignreviewer->reviewer->gender=='m')남 @else여@endif</span>
		<span class="bar">{{$campaignreviewer->age}}</span>
		<span class="bar">{{$campaignreviewer->area}}</span>
		<span class="td-btn">
                           @if($campaignreviewer->plan)
                           <a href="" data-r="{{$campaignreviewer->reviewer->id}}" class="btn small show_plan">리뷰<em class="m-dp-b">전략</em></a>
                           @else
                           <a class="btn small null">리뷰전략없음</a>
                           @endif
        </span>
		<span>
            @if($campaignreviewer->take_visit_check)
            <a class="btn small take_visit">완료</a>
            @else
            <a class="btn small take_visit off">미완료</a>
            @endif
        </span>
        <span>
            @if($campaignreviewer->take_visit_check)
            <a class="btn small take_visit">제출</a>
            @else
            <a class="btn small take_visit off">미제출</a>
            @endif
        </span>
        <span class="td-btn2">
                           <a data-re="{{$campaignreviewer->reviewer->id}}" data-ad="{{auth()->guard('advertiser')->user()->id}}" class="btn small chat_button">채팅하기</a>
        </span>
	</li>
    @empty
    <li>해당 리뷰어가 없습니다.</li>
    @endforelse
</ul>
