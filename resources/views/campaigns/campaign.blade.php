<li>
	<div class="campaign-item">
		<a href="campaign_view.php">
		<div class="thum">
			<img src="/files/{{$campaign->main_image}}" alt="플래티넘 캠페인 이미지">
		</div>
		<div class="info">
			<span class="ico-tag">
				<span class="{{$campaign->form}}">@if($campaign->form=='v')방문@else재택@endif</span>
				<span class="bg-bl">{{$campaign->brand->category->name}}</span>
				<span class="dday @if($campaign->rightNow=='Day') on @endif">D-{{$campaign->rightNow}}</span>
			</span>
			<div class="txt-box">
				<p class="txt-top">
					<span class="sns"><span class="channel{{$campaign->channel->id}}">{{$campaign->channel->name}}</span></span>
					<span class="num"><b>신청 22</b> / {{$campaign->recruit_number}}명</span>
				</p>
				<span class="subject">{{$campaign->name}}</span>
				<span class="subtxt">{{number_format($campaign->offer_point)}}point / {{$campaign->offer_goods}} 제공</span>							
			</div>
		</div>
		</a>
	</div>
</li>