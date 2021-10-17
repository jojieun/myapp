@extends('layouts.main')
@section('content')

			<!-- 왼쪽메뉴 -->
			@include('reviewers.reviewer_leftmenu')
						
			<!-- 오른쪽 컨텐츠 -->
			<div class="right-content">
                <div class="my-reviewer-top top2">
					<dl class="full_width">
						<dt><b>나의 리뷰전략</b><a href="{{route('plans.edit', $plan->id)}}">리뷰전략 수정</a></dt>
<!--
						<dd>
							<div class="my_graph">
								<span class="g-bar" style="width:80%">
									<span class="num">80%</span>
								</span>
							</div>
						</dd>
-->
					</dl>
				</div>

				<!-- 나의 리뷰전략 -->
				<div class="table_default influencer-view bt0">
					<div class="table_th">
						<span class="title">{{$plan->title}}</span>
					</div>

					<div class="table_td">
						<div class="table_td_line">
							<div class="view-img">
								@if($plan->profile_image)
                            <img src="/files/profile/{{$plan->profile_image}}" alt="">
                            @else
							<img src="/img/sub/ico_influencer.gif" alt="">
                            @endif
							</div> 

							<div class="view-info">
								<dl>
									<dt>이름/닉네임</dt>
									<dd>{{$plan->reviewer->name}} / {{$plan->reviewer->nickname}}</dd>
								</dl>
								<dl>
									<dt>연락처</dt>
									<dd>{{$plan->reviewer->mobile_num}}
										<span class="tell-ok">통화가능시간 | {{$plan->call_time}}</span>
									</dd>
								</dl>
								<dl>								
									<dt>이메일</dt>
									<dd>{{$plan->reviewer->email}}</dd>	
								</dl>
								<dl>							
									<dt>SNS</dt>
									<dd class="sns">
										@foreach($plan->reviewer->channelreviewers as $chal)
                                    <span class="channel{{$chal->channel->id}}"><a href="{{$chal->channel->url}}{{$chal->name}}" target="_blank">{{$chal->channel->url}}{{$chal->name}}</a></span>
                                    @endforeach
									</dd>	
								</dl>
								<dl>							
									<dt>주소</dt>
									<dd>[{{$plan->reviewer->zipcode}}]
                                {{$plan->reviewer->address}}
                                {{$plan->reviewer->detail_address}}</dd>
								</dl>
							</div>
						</div>				
					</div>
					<div class="table_td">
						<div class="table_td_line">
							<div class="view-title">
								<h3>희망 캠페인 조건</h3>
							</div> 

							<div class="view-info">
								<dl>
								<dt>지역</dt>
								<dd>@foreach($plan->areas as $area)
                                        {{$area->region->name}} 
                                        {{$area->name}}
                                        @if(!$loop->last), @endif
                                        @endforeach</dd>
							</dl>
							<dl>
								<dt>카테고리</dt>
								<dd>@foreach($plan->categories as $category)
                                        {{$category->name}}
                                        @if(!$loop->last), @endif
                                        @endforeach</dd>
							</dl>
							<dl>								
								<dt>리워드</dt>
								<dd>{{$plan->reward}}P</dd>	
							</dl>
							</div>
						</div>				
					</div>

					<div class="table_td">
						<div class="table_td_line">
							<div class="view-title">
								<h3>리뷰전략</h3>
							</div>
							<div class="view-info">
								{!!nl2br($plan->review_plan)!!}
							</div>
						</div>				
					</div>

				</div>
				<!-- //나의 리뷰전략 -->
                <div class="join_btn_wrap">
					<a class="btn" href="{{route('plans.edit', $plan->id)}}">리뷰전략 수정</a>
                    <a class="btn black" href="{{route('main')}}">체험단 신청</a>
				</div>
			</div>
			<!-- //오른쪽 컨텐츠 -->
		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>
<script>
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
       } 
    });
    //    이미지업로드바로보기
    $('input[name=profile_image]').change(function(e){
       e.preventDefault();
        $('label[for=file]').css({
                   backgroundImage:"url('"+ URL.createObjectURL(event.target.files[0])+"')"
               });
         });
        //-----이미지업로드바로보기
    
    // 캠페인 region 선택 area_s출력
    var nowRegion;// 현재지역명 기억
    $('input[name=region]').change(function(e){
       e.preventDefault();
        var now = $('input[name=region]:checked').val();
        nowRegion = $('input[name=region]:checked').next().html();
        var $data = new FormData();
        $data.append('region', now);
        $.ajax({
            headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	},
        type: 'POST',
        url: "{{ route('campaigns.makearea') }}",
        data: $data,
        success: function(data) {
            var obj = data.areas;
            var your_html = "";
            $.each(obj, function (key, val) {
                your_html += '<li><span class="input-button4"><input name="area_s" type="radio" id="area2-'+val.id+'" value="'+val.id+'"><label for="area2-'+val.id+'">'+  val.name +'</label></span></li>'
            });
         $("#select_area").html(your_html) 
        },
        error: function(data) {
        },
        processData: false,
        contentType: false
            });
    });
    // ------캠페인 region 선택 area출력
    
    //area_s선택시 선택된 지역 / 히든인풋 출력
    $('#select_area').on('change','input[name=area_s]',function(e){
       e.preventDefault();
        var now = $('input[name=area_s]:checked').val();
        var nowArea = $('input[name=area_s]:checked').next().html();
        var myP = '<p>'+nowRegion+' > '+nowArea+'<button type="button" class="p_close"><img src="/img/common/ico_close2.png" alt="닫기"></button><input type="hidden" name="area[]" value="'+now+'"></p>';
        $('#last_area').append(myP);
    });
    // 선택된 지역 삭제
    $('#last_area').on('click','.p_close',function(e){
        e.preventDefault();
        $(this).parent().remove();
    })
</script>


@include('reviewers.reviewer_bottommenu')
@endsection