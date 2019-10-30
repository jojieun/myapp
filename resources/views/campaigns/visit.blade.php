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
						<span class="input-button2"><input name="channel" type="checkbox" id="channel00" value="0"><label for="channel00">전체</label></span>
                        @foreach($channels as $chl)
						<span class="input-button2"><input name="channel" type="checkbox" id="channel0{{$chl->id}}" value="{{$chl->id}}"><label for="channel0{{$chl->id}}">{{$chl->name}}</label></span>
                        @endforeach
					</dd>
				</dl>
				<dl>
					<dt>카테고리</dt>
					<dd>
						<span class="input-button"><input name="category" type="checkbox" id="category00"><label for="category00">전체</label></span>
                        @foreach($categories as $cate)
						<span class="input-button"><input name="category" type="checkbox" id="category0{{$cate->id}}" value="{{$cate->id}}"><label for="category0{{$cate->id}}">{{$cate->name}}</label></span>
                        @endforeach
					</dd>
				</dl>
			</div>
		</section>	
		<!-- //상단 카테고리 필터 -->

		<div class="m-bg-f4">		
			<section class="content-in2">
				<!-- 상단 리스트 필터 -->
				<div class="list-filter">
					<p>{{$campaigns->count()}}개의 캠페인</p>
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
                        <?
//                        캠페인 형태 방문으로 지정
                        $campaign->form = 'v';
                        ?>
				            @include('campaigns.campaign')
                        @empty
                            <div class="text-center">
                            캠페인이 없습니다.
						  </div>
                        @endforelse
					</ul>
				</div>
                @if($campaigns->count())
                <div class="text-center paginator__article">
                  {!! $campaigns->render() !!}
                </div>
                @endif
			</section>
		</div>
	</div>
<script>
$('input[name=channel]').change(function(){
    
});
</script>
@endsection
