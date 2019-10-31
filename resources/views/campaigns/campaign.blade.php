<li>
    <? $locaOrCate = $campaign->region_name?$campaign->region_name.' '.$campaign->area_name:$campaign->category_name;//위치 또는 카테고리 표시?>
	<div class="campaign-item">
		<a href="{{ route('campaigns.show', [$campaign->id, 'd'=>$campaign->rightNow, 'applyCount'=>$campaign->applyCount, 'locaOrCate'=>$locaOrCate]) }}">
		<div class="thum">
			<img src="/files/{{$campaign->main_image}}" alt="플래티넘 캠페인 이미지">
		</div>
		<div class="info">
			<span class="ico-tag">
				@if($campaign->form == 'v')
                <span class="v">방문</span>
                @else
                <span class="h">재택</span>
                @endif
				<span class="bg-bl">
                {{$locaOrCate}}
                </span>
				<span class="dday @if($campaign->rightNow=='Day') on @endif">D-{{$campaign->rightNow}}</span>
			</span>
			<div class="txt-box">
				<p class="txt-top">
					<span class="sns"><span class="channel{{$campaign->channel_id}}">{{$campaign->channel_name}}</span></span>
					<span class="num"><b>신청 {{$campaign->applyCount}}</b> / {{$campaign->recruit_number}}명</span>
				</p>
				<span class="subject">{{$campaign->name}}</span>
				<span class="subtxt">{{number_format($campaign->offer_point)}}point / {{$campaign->offer_goods}} 제공</span>							
			</div>
		</div>
		</a>
	</div>
</li>