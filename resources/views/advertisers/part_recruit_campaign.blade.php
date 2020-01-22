<ul class="reviewer-th">
	<li>NO</li>
	<li>닉네임</li>
	<li>성별</li>
	<li>나이</li>
	<li>지역</li>
	<li>신청날짜</li>
	<li>리뷰전략</li>
<!--
	<li>활동채널</li>
    <li>방문자수</li>
-->
	<li>광고주<br/>만족도</li>
	<li>리뷰어선택</li>
</ul>
<ul class="reviewer-td">
    @forelse($campaignreviewers as $campaignreviewer)
    <li>
		<span class="bar">{{ $loop->iteration }}</span>
		<span class="bar">{{$campaignreviewer->reviewer->nickname}}</span>
		<span class="bar">@if($campaignreviewer->reviewer->gender=='m')남 @else여@endif</span>
		<span class="bar">{{$campaignreviewer->age}}</span>
		<span class="bar">{{$campaignreviewer->area}}</span>
		<span>{{$campaignreviewer->created_at->todatestring()}}<em> 신청</em></span>
		<span class="td-btn">
                           @if($campaignreviewer->plan)
                           <a href="" data-r="{{$campaignreviewer->reviewer->id}}" class="btn small show_plan">리뷰<em class="m-dp-b">전략</em></a>
                           @else
                           <a class="btn small null">리뷰전략없음</a>
                           @endif
        </span>
<!--
		<span class="sns"><span class="blog">네이버블로그</span></span>
                       <span class="bar"><em>방문자 </em>15000</span>
-->
		<span><em>광고주만족도 </em>{{$campaignreviewer->sati}}</span>
		<span class="td-btn2">
			<span class="input-button"><input type="checkbox" name="selected[]" id="reviewer{{$campaignreviewer->id}}" value="{{$campaignreviewer->id}}" class="reviewer_select"><label for="reviewer{{$campaignreviewer->id}}"><em>리뷰어<span class="m-dp-b">선택</span></em></label></span>
		</span>
                       
	</li>
    @empty
    <li>해당 리뷰어가 없습니다.</li>
    @endforelse
</ul>