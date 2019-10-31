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
						<p class="btn-share"><a href="#"><img src="/img/common/ico_share.gif" alt="공유하기"></a></p>
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
						<a href="#" class="btn gray">관심캠페인</a>
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
						{{$campaign->mission}}
					</dd>
				</dl>
				<dl id="campaign03" class="detail-txt">
					<dt>리뷰키워드</dt>
					<dd>{{$campaign->keyword}}</dd>
				</dl>
				<dl id="campaign04" class="detail-txt">
					<dt>방문안내</dt>
					<dd>
						<p class="map">
							<img src="/img/sub/img_map.jpg" alt="지도영역">
						</p>
						<p>
							{{$campaign->visit_time}}
						</p>
					</dd>
				</dl>
				<dl id="campaign05" class="detail-txt">
					<dt>기타사항</dt>
					<dd>{{$campaign->etc}}</dd>
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
						<li>
							<div class="campaign-item">
								<a href="#">
								<div class="thum">
									<img src="/img/main/img_thumb.jpg" alt="플래티넘 캠페인 이미지">
								</div>
								<div class="info">
									<span class="ico-tag">
										<span class="type01">방문</span>
										<span class="bg-bl">뷰티</span>
										<span class="dday">D-11</span>
									</span>
									<div class="txt-box">
										<p class="txt-top">
											<span class="sns"><span class="insta">인스타그램</span></span>
											<span class="num">10명 모집</span>
										</p>
										<span class="subject">[휴랩] 마르지 않는 물걸레 청소기</span>
										<span class="subtxt">아르투아 산토리니 폼클렌저 제공</span>							
									</div>
								</div>
								</a>
							</div>
						</li>
						<li>
							<div class="campaign-item">
								<a href="#">
								<div class="thum">
									<img src="/img/main/img_thumb.jpg" alt="플래티넘 캠페인 이미지">
								</div>
								<div class="info">
									<span class="ico-tag">
										<span class="type01">방문</span>
										<span class="bg-bl">뷰티</span>
										<span class="dday">D-11</span>
									</span>
									<div class="txt-box">
										<p class="txt-top">
											<span class="sns"><span class="insta">인스타그램</span></span>
											<span class="num">10명 모집</span>
										</p>
										<span class="subject">[휴랩] 마르지 않는 물걸레 청소기</span>
										<span class="subtxt">아르투아 산토리니 폼클렌저 제공</span>							
									</div>
								</div>
								</a>
							</div>
						</li>
						<li>
							<div class="campaign-item">
								<a href="#">
								<div class="thum">
									<img src="/img/main/img_thumb.jpg" alt="플래티넘 캠페인 이미지">
								</div>
								<div class="info">
									<span class="ico-tag">
										<span class="type01">방문</span>
										<span class="bg-bl">뷰티</span>
										<span class="dday">D-11</span>
									</span>
									<div class="txt-box">
										<p class="txt-top">
											<span class="sns"><span class="blog">네이버블로그</span></span>
											<span class="num">10명 모집</span>
										</p>
										<span class="subject">[휴랩] 마르지 않는 물걸레 청소기</span>
										<span class="subtxt">아르투아 산토리니 폼클렌저 제공</span>							
									</div>
								</div>
								</a>
							</div>
						</li>
						<li>
							<div class="campaign-item">
								<a href="#">
								<div class="thum">
									<img src="/img/main/img_thumb.jpg" alt="플래티넘 캠페인 이미지">
								</div>
								<div class="info">
									<span class="ico-tag">
										<span class="type01">방문</span>
										<span class="bg-bl">뷰티</span>
										<span class="dday">D-11</span>
									</span>
									<div class="txt-box">
										<p class="txt-top">
											<span class="sns"><span class="blog">네이버블로그</span></span>
											<span class="num">10명 모집</span>
										</p>
										<span class="subject">[휴랩] 마르지 않는 물걸레 청소기</span>
										<span class="subtxt">아르투아 산토리니 폼클렌저 제공</span>							
									</div>
								</div>
								</a>
							</div>
						</li>
						<li>
							<div class="campaign-item">
								<a href="#">
								<div class="thum">
									<img src="/img/main/img_thumb.jpg" alt="플래티넘 캠페인 이미지">
								</div>
								<div class="info">
									<span class="ico-tag">
										<span class="type01">방문</span>
										<span class="bg-bl">뷰티</span>
										<span class="dday">D-11</span>
									</span>
									<div class="txt-box">
										<p class="txt-top">
											<span class="sns"><span class="blog">네이버블로그</span></span>
											<span class="num">10명 모집</span>
										</p>
										<span class="subject">[휴랩] 마르지 않는 물걸레 청소기</span>
										<span class="subtxt">아르투아 산토리니 폼클렌저 제공</span>							
									</div>
								</div>
								</a>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</section>
		<!-- //추천 캠페인 -->
	</div>
<!--캠페인신청시필요-->
@component('help.pop_review')
@endcomponent
<!--신청약관-->
@include('campaigns.pop_term')
@component('help.popup_ok')
신청
@endcomponent
<script>
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
       } 
    });
     $('.apply_check').on('click', function(e){
         e.preventDefault();
         @if(isset(auth()->user()->name))
         window.location.hash = '#popup_term';
         @else
         window.location.hash = '#pop_review';
         @endif
         
     });
 $('#campaign_apply').on('click', function(e){
     e.preventDefault();
     if($('#checkAgree1').is(':checked') && $('#checkAgree2').is(':checked')){
         var camid = $(this).attr('value');
        $.ajax({
           type:"POST",
           url:"{{ route('reviewers.apply') }}",
           data:{camid:camid},
           success:function(){
                window.location.hash = '#popup_ok';
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
</script>
@endsection