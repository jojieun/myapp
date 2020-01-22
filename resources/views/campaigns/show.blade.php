@extends('layouts.main')
@section('content')
<div class="sub-container">
		<ul class="campaign_tab @if($campaign->form=='h') w5 @endif">
			<li class="on"><a href="#"><span>캠페인</span><span>개요</span></a></li>
			<li><a href="#campaign01"><span>상세</span><span>이미지</span></a></li>
			<li><a href="#campaign02"><span>리뷰</span><span>미션</span></a></li>
			<li><a href="#campaign03"><span>리뷰</span><span>키워드</span></a></li>
            @if($campaign->form=='v')
			<li><a href="#campaign04"><span>방문</span><span>안내</span></a></li>
            @endif
			<li><a href="#campaign05"><span>기타</span><span>사항</span></a></li>
		</ul>
	
		<!-- 캠페인 개요 -->
		<section class="bg-gray">
			<div class="content-in-sub-top pt2 mt120">
				<div class="campaign-detail-img">
					<img src="/files/{{$campaign->main_image}}" alt="">
				</div> 

				<div class="campaign-detail-info">
					<div class="detail-info-top ">
						<p class="tag-area">
							@if($campaign->form == 'v')
                            <span class="v">방문</span>
                            @else
                            <span class="h">재택</span>
                            @endif
							<span class="bg-bl">{{ $locaOrCate }}</span>
							<span class="sns"><span class="channel{{$campaign->channel->id}}">{{$campaign->channel->name}}</span></span>
						</p>
						<p class="tag-area-right">
							<span class="num"><b>신청 {{ $applyCount }}</b> / {{$campaign->recruit_number}}명</span>
							<span class="dday @if($d=='Day') on @endif">D-{{$d}}</span>
						</p>
						<h3>{{$campaign->name}}</h3>
						<dl class="detail-info">
							<dt>제공내역</dt>
							<dd>
								{{$campaign->offer_goods}}
							</dd>
						</dl>
						<p class="btn-share"><img src="/img/common/ico_share.gif" alt="공유하기" class="share" data-clipboard-text="{{url()->full()}}">
                        </p>
					</div>
					<dl class="detail-info">
						<dt>캠페인일정</dt>
						<dd>
							<p><span class="detail-title">리뷰어 신청기간</span><span><b>{{$campaign->start_recruit}} ~ {{$campaign->end_recruit}}</b></span></p>
							<p><span class="detail-title">리뷰어 발표</span><span>{{$reviewer_announce}}</span></p>
							<p><span class="detail-title">리뷰 등록기간</span><span>{{$start_submit}} ~ {{$campaign->end_submit}}</span></p>
							<p><span class="detail-title">캠페인 결과발표</span><span>{{$result_announce}}</span></p>
						</dd>
					</dl>
					<span class="detail-btn">
						<a class="btn black big apply_check" href="#popup_term">신청하기</a>
						<a href="#" id="bookmark" class="btn gray" value="{{$campaign->id}}">관심캠페인</a>
					</span>
				</div>
			</div>
		</section>	
		<!-- //캠페인 개요 -->

		<span class="m-bar"></span>

		<!-- 캠페인 내용 -->
		<section class="content-in-sub">			
			<!-- 우측메뉴 -->
			<div id="navbar" class="campaign-detail-navi">
				<ul>
					<li class="on"><a href="#">캠페인개요</a></li>
					<li><a href="#campaign01">상세이미지</a></li>
					<li><a href="#campaign02">리뷰미션</a></li>
					<li><a href="#campaign03">리뷰키워드</a></li>
                    @if($campaign->form=='v')
			         <li><a href="#campaign04">방문안내</a></li>
                    @endif
					<li><a href="#campaign05">기타사항</a></li>
				</ul>
				<a  class="btn black apply_check">신청하기</a>
			</div>
			<!-- //우측메뉴 -->
			<div class="campaign-detail-txt">
				<div id="campaign01">
                    @if($campaign->sub_image1)
                    <img src="/files/{{$campaign->sub_image1}}" alt="상세이미지영역">
                    @endif
                    @if($campaign->sub_image2)
                    <img src="/files/{{$campaign->sub_image2}}" alt="상세이미지영역">
                    @endif
                    @if($campaign->sub_image3)
                    <img src="/files/{{$campaign->sub_image3}}" alt="상세이미지영역">
                    @endif

				</div>
				<dl id="campaign02" class="detail-txt">
					<dt>리뷰미션</dt>
					<dd>
						{!! nl2br($campaign->mission) !!}
					</dd>
				</dl>
				<dl id="campaign03" class="detail-txt">
					<dt>리뷰키워드</dt>
					<dd>{{$campaign->keyword}}</dd>
				</dl>
                 @if($campaign->form=='v')
				<dl id="campaign04" class="detail-txt">
					<dt>방문안내</dt>
					<dd>
						<p class="map" id="map">
						</p>
                        <p>
							{{$campaign->address}}
                            {{$campaign->detail_address}}
						</p>
						<p>
							방문가능시간 : {{$campaign->visit_time}}
						</p>
					</dd>
				</dl>
                @endif
				<dl id="campaign05" class="detail-txt">
					<dt>기타사항</dt>
					<dd>{!! nl2br($campaign->etc) !!}</dd>
				</dl>
			</div>
		</section>
		<!-- //캠페인 내용 -->

		<!-- 추천 캠페인 -->
		<section class="bg-gray2">
			<div class="content-in-sub mt7b4">
				<h3>추천 캠페인</h3>
				<div class="campaign-list w5">
					<ul>
                        <? $campaigns = $recommends ?>
						@include('campaigns.part_campaign')
					</ul>
				</div>
			</div>
		</section>
		<!-- //추천 캠페인 -->
	</div>
<!--캠페인신청시필요-->
@component('help.pop_require')
    @slot('goId')
        pop_review
    @endslot
    @slot('for')
        캠페인 신청을 위해
    @endslot
    @slot('what')
        리뷰어 로그인
    @endslot
    @slot('where')
        {{ route('sessions.create') }}
    @endslot
@endcomponent
<!--관심캠페인 등록시 로그인 필요-->
@component('help.pop_require')
    @slot('goId')
        pop_login
    @endslot
    @slot('for')
        관심캠페인 등록을 위해
    @endslot
    @slot('what')
        로그인
    @endslot
    @slot('where')
        {{ route('sessions.create') }}
    @endslot
@endcomponent
<!--신청약관-->
@include('campaigns.pop_term')
<!--신청완료알림-->
@component('help.popup_ok')
    @slot('goId')
        popup_ok
    @endslot
    신청이 완료되었습니다.
@endcomponent
<!--공유url복사 안내-->
@component('help.popup_ok')
    @slot('goId')
        copy_ok
    @endslot
    링크가 복사되었습니다.
@endcomponent
<!--공유url복사 안내-->
@component('help.popup_ok')
    @slot('goId')
        bookmark_ok
    @endslot
    관심캠페인에 등록되었습니다.
@endcomponent
<!--중복신청알림-->
@component('help.popup_ok')
    @slot('goId')
        pre_apply
    @endslot
    이미 신청한 캠페인입니다.
@endcomponent
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=2014fb587b83de3123a5fcf612f0b7c9&libraries=services"></script>
<script src="https://cdn.jsdelivr.net/npm/clipboard@2/dist/clipboard.min.js"></script>
<script>
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
       } 
    });
    //*******지도 띄우기
    if('{{$campaign->form}}'=='v'){
var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
    mapOption = {
        center: new kakao.maps.LatLng(33.450701, 126.570667), // 지도의 중심좌표
        level: 4 // 지도의 확대 레벨
    };  

// 지도를 생성합니다    
var map = new kakao.maps.Map(mapContainer, mapOption); 

// 주소-좌표 변환 객체를 생성합니다
var geocoder = new kakao.maps.services.Geocoder();

// 주소로 좌표를 검색합니다
geocoder.addressSearch('{{$campaign->address}}', function(result, status) {

    // 정상적으로 검색이 완료됐으면 
     if (status === kakao.maps.services.Status.OK) {

        var coords = new kakao.maps.LatLng(result[0].y, result[0].x);

        // 결과값으로 받은 위치를 마커로 표시합니다
        var marker = new kakao.maps.Marker({
            map: map,
            position: coords
        });

        // 지도의 중심을 결과값으로 받은 위치로 이동시킵니다
        map.setCenter(coords);
    } 
});
};
    //클립보드에 주소 복사
var clipboard =  new ClipboardJS( '.share' );   // 클래스의 값이 btn인 요소를 복사
clipboard.on( 'success', function() {       // 복사에 성공했을 때
 window.location.hash = '#copy_ok';
} );
    
     $('.apply_check').on('click', function(e){
         e.preventDefault();
         @if(isset(auth()->user()->name))
         window.location.hash = '#popup_term';
         @else
         window.location.hash = '#pop_review';
         @endif
         
     });
         //캠페인신청
 $('#campaign_apply').on('click', function(e){
     e.preventDefault();
     if($('#checkAgree1').is(':checked') && $('#checkAgree2').is(':checked')){
         var camid = $(this).attr('value');
        $.ajax({
           type:"POST",
           url:"{{ route('reviewers.apply') }}",
           data:{camid:camid},
           success:function(data){
               if(data.pre_apply){
                   window.location.hash = '#pre_apply';
               } else {
                window.location.hash = '#popup_ok';
                   }
            },
            error: function(data) {
                if(data.status==401){
                    window.location.hash = '#pop_review';
                }
            },
        });
         
     } else {
         alert('약관에 동의해주세요');
     }
    });
    $('#bookmark').on('click', function(e){
     e.preventDefault();
     @if(isset(auth()->user()->name))
         var camid = $(this).attr('value');
        $.ajax({
           type:"POST",
           url:"{{ route('reviewers.bookmark') }}",
           data:{camid:camid},
            success:function(){
                window.location.hash = '#bookmark_ok';
            },
            error: function(data) {

            },
        });
     @else
         window.location.hash = '#pop_login';
     @endif
    });
</script>
@endsection