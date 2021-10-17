@extends('layouts.main')
@section('content')

			@include('advertisers.advertiser_leftmenu')	
                        <!-- 오른쪽 컨텐츠 -->
			<div class="right-content">
				<h2 class="m-text-left">모집현황</h2>				
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
    				<span style="margin-left:10px;" class="dday @if($campaign->rightNow=='Day') on @endif">D-{{$campaign->rightNow}}</span>		
						</p>									
						<p class="subject">{{$campaign->name}}</p>
						<p class="subtxt">{{$campaign->offer_goods}} 지급 + {{number_format($campaign->offer_point)}} 포인트 지급 </p>
					</div>
					<div class="campaign-list-info-right">
						<p class="num">
							<span class="title">신청인원</span>
							<span class="txt"><b>{{$r_count}}</b> / {{$campaign->recruit_number}}</span>
						</p>
					</div>
				</div>

				<!-- 캠페인 신청 리뷰어 통계 -->
				<div class="campaign-statistics">
					<h3>캠페인 신청 리뷰어 통계</h3>
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

				<!-- 신청 리뷰어 -->
				<div class="reviewer up_r" id="reviewer1">
                    <form method="post" action="{{ route('advertisers.select_reviewer', $campaign->id) }}" id="select_form">
                        {!! csrf_field() !!}
                    <? $campaignreviewers = $campaignreviewers1; ?>
					<h3>신청 리뷰어</h3>
                    @include('advertisers.part_recruit_campaign')
                        <div id="pay_preview" class="table_form2 mb20 pay">
                            <dl>
							<dt>결제내역</dt>
							<dd>
								<div class="price-list">
                                    <p>
										<span>중개수수료(선정인원X5,000원)@if($campaign->fee_waiver>0)<strong class="if_pay">-옵션구매{{$campaign->fee_waiver}}명면제</strong>@endif</span>
										<span class="price"><b id="basic_price">0</b>원</span>
									</p>
									<p>
										<span>리뷰어 제공 포인트</span>
										<span class="price"><b id="point_price">0</b>원</span>
									</p>
									<p class="total-price">
										<span>합계</span>
										<span class="price"><b class="orange" id="total_price">0</b><span class="orange">원</span></span>
									</p>
								</div>
								<div class="price-pay">
									<p>+부가세(10%) <span id="vat">0</span>원</p>
									<p class="txt">총 결제금액</p>
									<p class="price"><b id="final_price">0</b>원</p>
                                    <input type="hidden" name="payment2" value="0">
								</div>
							</dd>
						</dl>
                        <dl class="if_pay">
							<dt>포인트사용</dt>
							<dd>
                                <div class="price-list">
                                    <p>
										<span>보유포인트 : <b id="has_point">{{$user->point}}</b>P</span>
										<span class="price">
                                            <input type="number" id="use_point" name="use_point" value="0"> P 사용
                                        </span>
									</p>
                                </div>
							</dd>
						</dl>
						<dl class="if_pay">
							<dt>결제방법</dt>
							<dd class="mt10">					
								<span class="input-button"><input name="pay_method" type="radio" id="pay1" value="card" checked><label for="pay1">신용카드</label></span>
								<span class="input-button"><input name="pay_method" type="radio" id="pay2" value="trans"><label for="pay2">실시간계좌이체</label></span>
								<span class="input-button"><input name="pay_method" type="radio" id="pay3" value="vbank"><label for="pay3">가상계좌</label></span>
							</dd>
						</dl>
					</div>
                        <div class="text-center">
                            <input type="hidden" name="name" value="{{$campaign->name}} 선정">
                            <input type="hidden" name="merchant_uid2" value="">
					<button type="button" class="btn black mt20" id="reviewer_select">선택 리뷰어 선정 (결제)</button>
                        </div>
@component('help.popup_confirm')
    @slot('goId')
        confirm
    @endslot
    선정 시 캠페인은 모집마감되고 리뷰가 진행됩니다.
@endcomponent
                        </form>
				</div>
				<!-- //신청 리뷰어 -->
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
@component('help.popup_ok')
    @slot('goId')
        cant_submit2
    @endslot
    선정할 리뷰어를 선택하세요.
@endcomponent

<!--//리뷰전략보기-->
@include('advertisers.advertiser_leftmenu_tail')
<script type="text/javascript" src="https://cdn.iamport.kr/js/iamport.payment-1.1.5.js"></script>
<script>
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
       }
    });
    var notWork = true;//결재진행 중복클릭 금지
    var merchant_uid2;
    //결제연동
    var IMP = window.IMP;
    IMP.init("imp81498957");
    var use_point = 0;
    var total = 0;//결제금액
    var notWork = true;//결재진행 중복클릭 금지
    var fee_waiver={{$campaign->fee_waiver}};//수수료 면제 인원
    //리뷰어 선택 체크
    $('#reviewer1 .reviewer_select').change(function(){
        var recruit_number = $('#reviewer1 .reviewer_select:checked').length;
            var pp = {{$campaign->offer_point}} * recruit_number;
            var bp = (recruit_number-fee_waiver)*5000;
        if(bp<0){
            bp =0;
        }
            $('#point_price').html(money(pp));
            $('#basic_price').html(money(bp));
            totalprice();
    });
    //포인트 사용
    $('#use_point').change(function(){
        use_point = $('#use_point').val();
        if(use_point> {{$user->point}}){
            use_point = {{$user->point}};
        }
        if(use_point > total){
            use_point = total;
        }
        $('#use_point').val(use_point);
        totalprice();
    });
    //    결제총합
    function totalprice(){
        total =  notmoney($('#point_price').html())+notmoney($('#basic_price').html());
        var vat = (total-use_point)*0.1;
        var final = (total-use_point)+vat;
        $('#total_price').html(money((total-use_point)));
        $('#vat').html(money(vat));
        $('#final_price').html(money(final));
        $('input[name=payment2]').val(final);
    }
//    --------결제총합
    //선정인원 제출시
    $('#select_form button[type=submit]').click(function(e){
        e.preventDefault();
//        e.returnValue = false;
        if(notWork){
            notWork=false;
            if($('input[name=payment2]').val()>0){
                var mytime = new Date().getTime();
                merchant_uid2 = 'mc_'+mytime;
                IMP.request_pay({ // param
                    pg: "danal_tpay",
                    pay_method: $('input[name=pay_method]:checked').val(),
                    merchant_uid: merchant_uid2,
                    name: $('input[name=name]').val(),
                    amount: $('input[name=payment2]').val(),
                    buyer_email: "{{ $user->email }}",
                    buyer_name: "{{ $user->name }}",
                    buyer_tel: "{{ $user->mobile_num }}",
                }, function (rsp) { // callback
                    if (rsp.success) {
                        // 결제 성공 시 로직,
                        $('input[name=merchant_uid2]').val(merchant_uid2);
                        // actually submit the form
                        location.hash = 'close';
                        $('#select_form').submit();
                    } else {
                        // 결제 실패 시 로직,
                        notWork=true;
                        var msg = '결제에 실패하였습니다.';
                        msg += '에러내용 : ' + rsp.error_msg;
                        alert(msg);
                        return false;
                    }
                });
            } else {
                $('#select_form').submit();
            }
        }
    });
    
    //리뷰전략 보기
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
    //선택 리뷰어 선정 클릭시
$('#reviewer_select').click(function(e) {
    var canNum = {{$campaign->recruit_number}};
    if($('#reviewer1 .reviewer_select:checked').length<1){
    location.hash = 'cant_submit2';
}else if($('#reviewer1 .reviewer_select:checked').length>canNum){
        location.hash = 'cant_submit';
    } else{
        location.hash = 'confirm';
    }
    
});
</script>
@include('help.money')
@endsection