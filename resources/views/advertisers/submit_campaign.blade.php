@extends('layouts.main')
@section('content')

			@include('advertisers.advertiser_leftmenu')	
                        <!-- 오른쪽 컨텐츠 -->
			<div class="right-content">
				<h2 class="m-text-left">진행결과</h2>				
				<div class="campaign-list-info2">
					<div class="list-info-top">
						<p class="tag-area">
							 @if($campaign->form == 'v')
    				<span class="v">방문</span>
                            <span class="bg-bl">
                            {{$campaign->area->region->name.' '.$campaign->area->name}}
                            </span>
                                @else
                                <span class="h">재택</span>
                            <span class="bg-bl">
                            {{$campaign->brandCategory->name}}
                            </span>
                            @endif
    				<span class="sns"><span class="channel{{$campaign->channel_id}}">{{$campaign->channel->name}}</span></span>
    				<span style="margin-left:10px;" class="dday @if($campaign->rightNow==0) on @endif"><small>리뷰제출마감</small> 
                        @if($campaign->rightNow>0)
                           D-{{$campaign->rightNow}}       
                        @elseif($campaign->rightNow==0)
                            D-day                       
                        @endif
                        </span>		
						</p>									
						<p class="subject">{{$campaign->name}}</p>
						<p class="subtxt">{{$campaign->offer_goods}} 지급 + {{number_format($campaign->offer_point)}} 포인트 지급 </p>
					</div>
					<div class="campaign-list-info-right">
						<p class="num">
							<span class="title">리뷰제출인원</span>
							<span class="txt"><b>{{$reviews->count()}}</b> / {{$campaign->campaignReviewers->count()}}</span>
						</p>
					</div>
				</div>

				<!-- 캠페인 신청 리뷰어 통계 -->
				<div class="campaign-statistics">
					<h3>선정 리뷰어 통계</h3>
					<dl class="sex">
						<dt>성별</dt>
						<dd>
							<div class="sex_graph">
								<span class="female">여자<br/>{{$gender_f}}%</span><span class="g-bar" style="width:{{$gender_f}}%"></span>
								<span class="male">남자<br/>{{100-$gender_f}}%</span><span class="g-bar bg-black" style="width:{{100-$gender_f}}%"></span>
							</div>
						</dd>
					</dl>
					<dl class="age">
						<dt>연령별</dt>
						<dd>
							<ul class="age_graph">
                                @foreach($ages as $age)
                                <li><span>{{$loop->iteration}}0대</span><div style="height:{{$age/$r_count*100}}%"><em>{{round($age/$r_count*100)}}%</em></div></li>
                                @endforeach
							</ul>
						</dd>
					</dl>
					<dl class="area">
						<dt>지역별</dt>
						<dd>
							<ul>
                                @forelse($regions as $key=>$value)
                                <li><span class="num">{{$loop->iteration}}.</span><span class="area-txt">{{$key}}</span><span class="fl-r">{{round($value/$r_count*100)}}%</span></li>
                                @if($loop->iteration==4)
                                @break
                                @endif
                                @empty
                                <li>데이터가 없습니다.</li>
                                @endforelse
							</ul>
						</dd>
					</dl>
				</div>
				<!-- //캠페인 신청 리뷰어 통계 -->
                
                
            
				<!-- 리뷰제출 리뷰어 -->
				<div class="reviewer" id="reviewer1">
                    <h3>리뷰제출 결과</h3>
					<ul class="reviewer-th2">
						<li>NO</li>
						<li>닉네임</li>
						<li>성별</li>
						<li>나이</li>
						<li>지역</li>
						<li>캠페인 참여 후기</li>
						<li>리뷰URL</li>
						<li>리뷰 만족도 평가</li>
					</ul>
					<ul class="reviewer-td2">
                    @include('advertisers.part_submit_campaign')
                        </ul>
<!--                    <a  href="{{route('down_reviewer_info',$campaign->id)}}" class="btn-down">리뷰어 정보 다운로드</a>-->
				</div>
				<!-- //리뷰제출 리뷰어 -->
<!--                선정된 리뷰어(배송방문현황)-->
                <div class="reviewer" id="reviewer2">
                    <form method="post" action="">
                        {!! csrf_field() !!}
					<h3>선정된 리뷰어 (진행 현황)</h3>
                    @include('advertisers.part_take_visit')
                        <a href="{{route('down_reviewer_info',$campaign->id)}}" class="btn-down">리뷰어 정보 다운로드</a>
                    </form>
				</div>
<!--                //선정된 리뷰어(배송방문현황)-->
			</div>
			<!-- //오른쪽 컨텐츠 -->
<!--리뷰전략보기-->
<a href="#" class="overlay" id="pop_plan"></a>
<div class="table_default influencer-view popup" id="pop_plan_view">
</div>
@component('help.popup_ok')
    @slot('goId')
        cant_submit
    @endslot
    모집인원을 초과해 선정 할 수 없습니다.
@endcomponent
<!--//리뷰전략보기-->
@include('advertisers.advertiser_leftmenu_tail')
<script>
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
       }
    });
    $('.show_plan').click(function(e){
       e.preventDefault();
        var reviewer_id = $(this).data('r');
        $.ajax({
           type:"GET",
           url:'/show_plan/' + reviewer_id,
            success: function(data){
                $('#pop_plan_view').html(data.showhtml)
                window.location.hash = '#pop_plan'; 
            }
        });
    });
    $('input.mystar').on('change', function(){
        $.ajax({
            type:"POST",
            url:"{{route('advertisers.satisfaction')}}",
            data:{
                reviewId:$(this).data('r'),
                val:$(this).val(),
                _token: $('meta[name="csrf-token"]').attr('content'),
            },
            success: function(data){
            
            },
            error:function(data){
            }
        });
    });
</script>
<!--광고주와 채팅-->
@include('advertisers.popup_chat')
@endsection