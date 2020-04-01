@extends('layouts.main')
@section('content')
<div class="sub-container bt-ddd">

    <section class="content-in-top2 mb80">
        <h2 class="m-ml3">인플루언서</h2>

        <div class="table_default influencer-view">
            <div class="table_th">
                <span class="title">{{$plan->title}}</span>
            </div>

            <!-- 광고주 로그인 -->
            @if(!Auth::guard('advertiser')->check())
            <p class="login-info">
                <span class="txt">광고주 회원으로 로그인하시면 <b>모든 정보를 확인</b> 하실 수 있습니다.</span>
                <span class="fl-r">
                    <a href="{{route('advertiser_sessions.create')}}" class="btn black h46">로그인</a>
                    <a href="{{route('advertisers.create')}}" class="btn h46">회원가입</a>
                </span>
            </p>
            @endif
            <!-- //광고주 로그인 -->

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
                        <!--
							<dl>
								<dt>연락처</dt>
								<dd>
                                    @if(Auth::guard('advertiser')->check())
                                    {{$plan->reviewer->mobile_num}}
                                    @else
                                    광고주회원에게만 공개됩니다. 
                                    @endif
									<span class="tell-ok">통화가능시간 | {{$plan->call_time}}</span>
								</dd>
							</dl>
							<dl>								
								<dt>이메일</dt>
								<dd>
                                    @if(Auth::guard('advertiser')->check())
                                    {{$plan->reviewer->email}}
                                    @else
                                    광고주회원에게만 공개됩니다. 
                                    @endif
                                    </dd>	
							</dl>
-->
                        <dl>
                            <dt>SNS</dt>
                            <dd class="sns">
                                @if(Auth::guard('advertiser')->check())
                                @foreach($plan->reviewer->channelreviewers as $chal)
                                <span class="channel{{$chal->channel->id}}"><a target="_blank" href="{{$chal->channel->url}}{{$chal->name}}">{{$chal->channel->url}}{{$chal->name}}</a></span>
                                @endforeach
                                @else
                                광고주회원에게만 공개됩니다.
                                @endif
                            </dd>
                        </dl>
                        <!--
							<dl>							
								<dt>주소</dt>
								<dd>
                                    @if(Auth::guard('advertiser')->check())
                                    [{{$plan->reviewer->zipcode}}]
                                {{$plan->reviewer->address}}
                                {{$plan->reviewer->detail_address}}
                                    @else
                                    광고주회원에게만 공개됩니다. 
                                    @endif
                                </dd>
							</dl>
-->
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
        <!-- //table_default-->

        <div class="text-center">
            <a href="#" class="btn big2 black mtb50" id="suggestion_campaign">리뷰제안</a>
        </div>
    </section>
</div>
<!--리뷰제안할 캠페인 선택화면-->
<a href="#" class="overlay" id="show_campaigns"></a>
<div class="popup term" id="">
    <div class="text3">
        <h3>리뷰제안 캠페인 선택</h3>
        <p>
        <select id="cam_list" class="full_width" style="padding:0 20px;">
        </select>
        </p>
        <button type="button" class="btn black h46" data-r="{{$plan->reviewer->id}}" id="reviewer_suggestion">리뷰제안</button>
    </div>
    <a class="close" href="#close"></a>
</div>
<!--리뷰제안시 광고주 로그인 필요-->
@component('help.pop_require')
@slot('goId')
pop_login
@endslot
@slot('for')
리뷰제안을 위해
@endslot
@slot('what')
광고주로그인
@endslot
@slot('where')
{{ route('advertiser_sessions.create') }}
@endslot
@endcomponent
<!--리뷰제안시 캠페인 등록 필요-->
@component('help.pop_require')
@slot('goId')
pop_require
@endslot
@slot('for')
리뷰제안을 위해
@endslot
@slot('what')
캠페인등록
@endslot
@slot('where')
{{ route('campaigns.create') }}
@endslot
@endcomponent
<!--리뷰제안완료-->
@component('help.popup_ok')
@slot('goId')
suggestion_ok
@endslot
리뷰제안이 완료되었습니다.
@endcomponent
<!--이미신청한리뷰어안내-->
@component('help.popup_ok')
@slot('goId')
pre_apply
@endslot
이미 해당 캠페인을 신청한 리뷰어입니다.
@endcomponent
<!--이미제안한리뷰어안내-->
@component('help.popup_ok')
@slot('goId')
pre_sugges
@endslot
이미 해당 캠페인을 제안했습니다.
@endcomponent
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //리뷰 제안할 캠페인 출력
    $('#suggestion_campaign').click(function(e) {
        e.preventDefault();
        @if(Auth::guard('advertiser') -> check())
        $.ajax({
            type: "GET",
            url: "{{ route('plans.suggestion_campaign') }}",
            success: function(data) {
                var obj = data.cams;
                if (obj) {
                    var your_html = "";
                    $.each(obj, function (key, val) {
                your_html += "<option value='"+val.id+"'>" +  val.name + "</option>"
                    });
                $("#cam_list").html(your_html);
                    window.location.hash = '#show_campaigns';
                } else {
                    window.location.hash = '#pop_require';
                }
            },
            error: function(data) {
                alert('캠페인을 불러오는 과정에 오류가 있습니다. 고객센터로 연락부탁드립니다.')
            },
        });
        @else
        window.location.hash = '#pop_login';
        @endif
    });
        //리뷰제안
        $('#reviewer_suggestion').click(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "{{ route('plans.reviewer_suggestion') }}",
            data: {reviewerId : $(this).data('r'), camId : $('#cam_list').val()},
            success: function(data) {
                if (data.pre=='cam') {
                    window.location.hash = '#pre_apply';
                } else if(data.pre=='sugges'){
                    window.location.hash = '#pre_sugges';
                } else {
                    window.location.hash = '#suggestion_ok';
                }
            },
            error: function(data) {
                alert('리뷰제안 과정에 오류가 있습니다. 고객센터로 연락부탁드립니다.')
            },
        });
    });
</script>
@endsection