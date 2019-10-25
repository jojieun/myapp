@extends('layouts.main')
@section('content')
<div class="sub-container bt-ddd">

		<!-- 상단 카테고리 필터 -->
		<section class="content-in-top">
			<div class="list_title">
				<h2>방문 캠페인</h2>
				<div class="map">
					<a href="#" class="btn-map">지역전체</a>
					<div class="map-on">&nbsp;</div>
				</div>
			</div>
			<div class="category">
				<dl>
					<dt>활동채널</dt>
					<dd>
						<span class="input-button2"><input name="" type="checkbox" id="channel01"><label for="channel01">전체</label></span>
						<span class="input-button2"><input name="" type="checkbox" id="channel02"><label for="channel02">네이버블로그</label></span>
						<span class="input-button2"><input name="" type="checkbox" id="channel03"><label for="channel03">인스타그램</label></span>
						<span class="input-button2"><input name="" type="checkbox" id="channel04"><label for="channel04">유튜브</label></span>
						<span class="input-button2"><input name="" type="checkbox" id="channel05"><label for="channel05">기타</label></span>
					</dd>
				</dl>
				<dl>
					<dt>카테고리</dt>
					<dd>
						<span class="input-button"><input name="" type="checkbox" id="category01"><label for="category01">전체</label></span>
						<span class="input-button"><input name="" type="checkbox" id="category02"><label for="category02">맛집</label></span>
						<span class="input-button"><input name="" type="checkbox" id="category03"><label for="category03">뷰티</label></span>
						<span class="input-button"><input name="" type="checkbox" id="category04"><label for="category04">숙박</label></span>
						<span class="input-button"><input name="" type="checkbox" id="category05"><label for="category05">문화</label></span>
						<span class="input-button"><input name="" type="checkbox" id="category06"><label for="category06">기타</label></span>				
					</dd>
				</dl>
			</div>
		</section>	
		<!-- //상단 카테고리 필터 -->

		<div class="m-bg-f4">		
			<section class="content-in2">
				<!-- 상단 리스트 필터 -->
				<div class="list-filter">
					<p>96,263개의 캠페인</p>
					<ul>
						<li class="on"><a href="#">최신순</a></li>
						<li><a href="#">마감임박순</a></li>
						<li><a href="#">인기순</a></li>
					</ul>
				</div>
				<!-- //상단 리스트 필터 -->

				<div class="campaign-list sub6">
					<ul>
                        @forelse($campaigns as $campaign)
				            @include('campaigns.campaign', compact('campaign'))
                        @empty
                            <div class="text-center">
                            캠페인이 없습니다.
						  </div>
                        @endforelse
					</ul>
				</div>
			</section>
		</div>
	</div>
@endsection