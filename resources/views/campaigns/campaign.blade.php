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
				<span class="dday on">D-DAY</span>
			</span>
			<div class="txt-box">
				<p class="txt-top">
					<span class="sns"><span class="channel2">인스타그램</span></span>
					<span class="num"><b>신청 22</b> / 10명</span>
				</p>
				<span class="subject">[휴랩] 마르지 않는 물걸레 청소기</span>
				<span class="subtxt">아르투아 산토리니 폼클렌저 제공</span>							
			</div>
		</div>
		</a>
	</div>
</li>