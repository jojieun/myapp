@extends('layouts.main')
@section('content')
@include('advertisers.advertiser_leftmenu')

@if(null !== Request::get('opbrand_id'))
<?php $opbrand_id = Request::get('opbrand_id'); ?>
@elseif(isset($campaign->brand_id))
<?php $opbrand_id = $campaign->brand_id; ?>
@else
<?php $opbrand_id = 1; ?>
@endif

<!--<form action="{{ route('campaigns.store') }}" method="post" class="form__auth" enctype="multipart/form-data" id="test_form">-->
    
    <form method="post" class="form__auth" enctype="multipart/form-data" id="test_form">
    {!! csrf_field() !!}
			<!-- 오른쪽 컨텐츠 1 -->
			<div class="right-content">
				<!-- 탭 -->
				<ul class="member-tab w3">
					<li class="on"><b>01</b> 기본정보 입력</li>
					<li><b>02</b> 상세정보 입력</li>
					<li><b>03</b> 결제</li>
				</ul>
				<!-- //탭 -->
				<!-- 기본정보 입력 -->
				<div class="">
					<!-- 이전 캠페인 불러오기 -->
<!--
					<div class="select-style01 mb20">
						<select name="" type="text" id="">
							@forelse($campaigns as $campaign)
							<option value="{{ $campaign->id }}">{{ $campaign->name }} [등록일 : {{ $campaign->updated_at }}]</option>		
                                     @empty
							<option value="">이전 캠페인이 없습니다</option>
                                     @endforelse
						</select>
					</div>
-->
					<!-- //이전 캠페인 불러오기 -->
					<div class="table_form2">
						<dl>
							<dt>브랜드선택</dt>
							<dd class="{{ $errors->has('brand_id') ? 'has-error' : '' }}">
								<div class="new-brand" style="overflow:hidden;">
									<select name="brand_id" type="text" id="brand_select">
                                        @include('campaigns.brand')
									</select>
                                    <a href="" class="btn delete" id="del_brand">선택 브랜드 삭제하기</a><a href="#add_brand" class="btn">새 브랜드 추가하기</a>
								</div>
                                {!! $errors->first('','<span class="red">:message</span>')!!}
                                <span class="red" id="brand_id"></span>
							</dd>
						</dl>
						<dl>
							<dt>캠페인 명</dt>
							<dd class="{{ $errors->has('name') ? 'has-error' : '' }}">
                                <input name="name" type="text" id="" value="{{ old('name') }}" placeholder="캠페인 이름을 입력해주세요" class="full_width" />
                                {!! $errors->first('name','<span class="red">:message</span>')!!}
                                <span class="red" id="name"></span>
                            </dd>
						</dl>						
						<dl>
							<dt>진행형태</dt>
							<dd class="{{ $errors->has('form') ? 'has-error' : '' }}">
								<span class="input-button3"><input name="form" type="radio" id="visit" value="v" @if( 'v' == old('form') ) checked @endif>
                                    <label for="visit">방문</label></span>
								<span class="input-button3"><input name="form" type="radio" id="home" value="h" @if( 'h' == old('form') ) checked @endif><label for="home">재택</label></span>
                                {!! $errors->first('form','<span class="red">:message</span>')!!}
                                <span class="red" id="form"></span>
							</dd>
						</dl>
						<dl>
							<dt>모집인원</dt>
							<dd class="{{ $errors->has('recruit_number') ? 'has-error' : '' }}">
								<div class="number">
									<button type="button" class="down" onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><img src="/img/common/btn_minus.gif" alt="-"></button>
									<input type="number" min="1" value="{{ old('recruit_number') ?: 1 }}" name="recruit_number">
									<button type="button" class="up" onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><img src="/img/common/btn_plus.gif" alt="+"></button>
                                    <span class="point-add">명</span>
								</div>
                                {!! $errors->first('recruit_number','<span class="red">:message</span>')!!}
                                <span class="red" id="recruit_number"></span>
							</dd>
						</dl>
						<dl>
							<dt>제공내역<a class="btn-question"></a>
								<div class="question">
									<p>리뷰어가 포인트 출금 신청 시, 수수료 3.3%와 이체 수수료를 공제 후 지급 됩니다.</p>
								</div>
							</dt>
							<dd>
                                <div class="{{ $errors->has('offer_point') ? 'has-error' : '' }}">
                                    <div class="number">
                                    <button type="button" class="down" onclick="this.parentNode.querySelector('input[type=number]').stepDown(5000)"><img src="/img/common/btn_minus.gif" alt="-"></button><input name="offer_point" type="number" min="0" id="" value="{{ old('offer_point') }}" placeholder=" " class="mb10" /><button type="button" class="up" onclick="this.parentNode.querySelector('input[type=number]').stepUp(5000)"><img src="/img/common/btn_plus.gif" alt="+"></button><span class="point-add">point  x  1인</span>
                                {!! $errors->first('offer_point','<span class="red">:message</span>')!!}
                                    <span class="red" id="offer_point"></span>
                                    </div>
                                    </div>
                                <div class="{{ $errors->has('offer_goods') ? 'has-error' : '' }}">
								<input name="offer_goods" type="text" id="" value="{{ old('offer_goods') }}" placeholder="제공 물품/서비스를 입력해주세요" class="full_width mb10" />
                                {!! $errors->first('offer_goods','<span class="red">:message</span>')!!}
                                    <span class="red" id="offer_goods"></span>
                                </div>
							</dd>
						</dl>
						<dl>
							<dt>모집채널</dt>
							<dd class="{{ $errors->has('channel_id') ? 'has-error' : '' }} mtb10">
                                @forelse($channels as $channel)		
                                <span class="input-button2"><input name="channel_id" type="radio" id="channel0{{$channel->id}}" value="{{$channel->id}}" @if( $channel->id == old('channel_id') ) checked @endif><label for="channel0{{$channel->id}}">{{$channel->name}}</label></span>
                                @empty
                                모집채널이 없습니다.
                                @endforelse
                                {!! $errors->first('channel_id','<span class="red">:message</span>')!!}
                                <span class="red" id="channel_id"></span>
							</dd>
						</dl>
						<dl>
							<dt>캠페인 일정<a class="btn-question"></a>
								<div class="question">
									<p>리뷰어 모집시작 : 하루 뒤 부터 가능<br/>리뷰어 모집기간 : 최소 7일<br/>리뷰 제출기간 : 최소 14일</p>
								</div>							
							</dt>
							<dd class="date">
								<p class="{{ $errors->has('start_recruit') ? 'has-error' : '' }} {{ $errors->has('end_recruit') ? 'has-error' : '' }}">
									<span class="title">리뷰어 모집기간</span>
									<span class="txt">
										<input value="{{ old('start_recruit')?: date('Y-m-d', strtotime('tomorrow')) }}" name="start_recruit" type="date" min="{{ date('Y-m-d', strtotime('tomorrow')) }}" size="20" title="시작일" class="m_mb10 input-date" /> <em>~</em>
										<input value="{{ old('end_recruit')?: date('Y-m-d', strtotime('+7 day')) }}" name="end_recruit" type="date" size="20" title="종료일" min="{{ date('Y-m-d', strtotime('+7 day')) }}" class="m_mb10 input-date" />
									</span>
                                    {!! $errors->first('start_recruit','<span class="red">:message</span>')!!}
                                    {!! $errors->first('end_recruit','<span class="red">:message</span>')!!}
								</p>
								<p>
                                    <span class="title">리뷰어 선정일</span>
									<span class="txt" id="pickday">{{ date('Y-m-d', strtotime('+8 day')) }}</span>
								</p>
								<p class="{{ $errors->has('end_submit') ? 'has-error' : '' }}">
                                    <span class="title">리뷰 제출기간</span>
									<span class="txt">
										<span class="gray-box" id="submit_start">{{ date('Y-m-d', strtotime('+9 day')) }}</span> <em>~</em>
										<input name="end_submit" type="date" size="20" title="종료일" class="m_mb10 input-date" value="{{ old('end_submit') ?: date('Y-m-d', strtotime('+22 day')) }}" min="{{ date('Y-m-d', strtotime('+22 day')) }}"/>
									</span>
                                    {!! $errors->first('end_submit','<span class="red">:message</span>')!!}
								</p>
								<p><span class="title">리뷰제출 종료일</span>
									<span class="txt" id="fin">{{ date('Y-m-d', strtotime('+23 day')) }}</span>
								</p>
                                <span class="red" id="start_recruit"></span>
                                    <span class="red" id="end_recruit"></span>
                                    <span class="red" id="end_submit"></span>
							</dd>
						</dl>
					</div>
				</div>
				<!-- //기본정보 입력 -->
				<div class="join_btn_wrap">
					<a class="btn black" id="first_btn">다음단계</a>
				</div>
				
			</div>
<!-- 오른쪽 컨텐츠 2 -->
			<div class="right-content">
				<!-- 탭 -->
				<ul class="member-tab w3">
					<li><b>01</b> 기본정보 입력</li>
					<li class="on"><b>02</b> 상세정보 입력</li>
					<li><b>03</b> 결제</li>
				</ul>
				<!-- //탭 -->
				<!-- 기본정보 입력 -->
				<div class="table_form2">
					<dl>
						<dt class="lh120">캠페인<br/>대표이미지<br/></dt>
						<dd class="{{ $errors->has('main_image') ? 'has-error' : '' }}">
							<div class="file-area">
								<span class="upload">
									<label for="file" @if(old('main_image')) style="background-image:url(/files/{{old('main_image')}});" @endif>									
										<input name="main_image" type="file" id="file" value="{{ old('main_image') }}" placeholder="상세이미지" class="full_width mb10" accept=".jpg,.jpeg,.png,.gif,.bmp"/>	
									</label>
								</span>
								<span class="add-txt">※ 대표이미지는 530*530 이상 정사각형 사이즈로 작업하여 업로드해주세요.</span>
							</div>
                            <span class="red" id="main_image"></span>
                            {!! $errors->first('main_image','<span class="red">:message</span>')!!}
						</dd>
					</dl>
					<dl class="bar">
						<dt class="lh120">상세이미지<br/></dt>
						<dd class="">
							<div class="file-area">
								<span class="upload2 {{ $errors->has('sub_image1') ? 'has-error' : '' }}">
									<label for="file1"><input name="sub_image1" type="file" id="file1" value="{{ old('detail_image1') }}" placeholder="상세이미지" class="mb10" accept=".jpg,.jpeg,.png,.gif,.bmp"/></label>
                                    {!! $errors->first('sub_image1','<span class="red">:message</span>')!!}
								</span>
                                <span class="red" id="sub_image1"></span>
								<span class="upload2 {{ $errors->has('sub_image2') ? 'has-error' : '' }}">
									<label for="file2"><input name="sub_image2" type="file" id="file2" value="{{ old('detail_image2') }}" placeholder="상세이미지" class="mb10" accept=".jpg,.jpeg,.png,.gif,.bmp"/></label>
                                    {!! $errors->first('sub_image2','<span class="red">:message</span>')!!}
								</span>
                                <span class="red" id="sub_image2"></span>
								<span class="upload2 {{ $errors->has('sub_image3') ? 'has-error' : '' }}">
									<label for="file3"><input name="sub_image3" type="file" id="file3" value="{{ old('sub_image3') }}" placeholder="상세이미지" class="mb10" accept=".jpg,.jpeg,.png,.gif,.bmp"/></label>
                                    {!! $errors->first('detail_image3','<span class="red">:message</span>')!!}
								</span>
                                <span class="red" id="sub_image3"></span>
							</div>
						</dd>
					</dl>
                    <div id="visit_only">
                        <dl>
                            <dt>캠페인지역</dt>
                            <dd>
                                <select id="regions" class="select_po">
                                    <option value="선택">선택</option>
                                     @forelse($regions as $region)
										<option value="{{ $region->id }}" @if( $region->id == old('region_id') ) selected @endif>{{ $region->name }}</option>		
                                        @empty
										<option value="">지역이 없습니다</option>
                                        @endforelse
                                </select>
                                <select id='areas' class='select_po hide' name='area_id' value="">
                                    <option value="">지역이 없습니다</option>
                                </select>
                                {!! $errors->first('area_id','<span class="red">:message</span>')!!}
                                <span class="red" id="area_id"></span>
                            </dd>
                        </dl>
					<dl>
						<dt>방문가능 시간</dt>
						<dd class="{{ $errors->has('visit_time') ? 'has-error' : '' }}">
                            <input name="visit_time" type="text" id="" value="{{ old('visit_time') }}" placeholder="예) 평일 10:00~17:00" class="full_width" />
                        {!! $errors->first('visit_time','<span class="red">:message</span>')!!}
                            <span class="red" id="visit_time"></span>
                        </dd>
					</dl>
					<dl>
						<dt>주소</dt>
						<dd class="{{ $errors->has('detail_address') ? 'has-error' : '' }} {{ $errors->has('address') ? 'has-error' : '' }}">
                            <input type="hidden" name="zipcode" placeholder="우편번호" value="{{old('zipcode')}}" id="sample6_postcode"/>
							<input name="address" type="text" placeholder="주소" class="w150 mb10" value="{{ old('address') }}" id="sample6_address"/><button type="button" name="button" class="btn btn-check" onclick="sample6_execDaumPostcode()">주소검색</button>
							<input name="detail_address" type="text" placeholder="상세주소" class="full_width" value="{{ old('detail_address') }}" id="sample6_detailAddress"/>
                            {!! $errors->first('address','<span class="red">:message</span>')!!}
                            {!! $errors->first('detail_address','<span class="red">:message</span>')!!}
                            <span class="red" id="address"></span>
                            <span class="red" id="detail_address"></span>
						</dd>
					</dl>
                        </div>
					<dl class="bar">
						<dt>담당자 연락처</dt>
						<dd class="{{ $errors->has('contact') ? 'has-error' : '' }}"><input name="contact" type="text" id="" value="{{ old('contact') }}" placeholder="선정된 리뷰어에게만 공개됩니다." class="full_width" />
                        {!! $errors->first('contact','<span class="red">:message</span>')!!}
                        <span class="red" id="contact"></span>
                        </dd>
					</dl>
					<dl>
						<dt>리뷰미션</dt>
						<dd class="{{ $errors->has('mission') ? 'has-error' : '' }}">
							<textarea name="mission" id="" cols="1" rows="5" placeholder="리뷰어에게 전달할 캠페인 상세 미션과 요청사항을 입력해주세요" class="border2">{{ old('mission') }}</textarea>
                            {!! $errors->first('mission','<span class="red">:message</span>')!!}
                            <span class="red" id="mission"></span>
						</dd>
					</dl>
					<dl>
						<dt>리뷰키워드</dt>
						<dd class="{{ $errors->has('keyword') ? 'has-error' : '' }}"><input name="keyword" type="text" id="" value="{{ old('keyword') }}" placeholder="리뷰어가 리뷰 작성시 사용할 키워드 또는 해시태그를 입력해주세요" class="full_width" />
                        {!! $errors->first('keyword','<span class="red">:message</span>')!!}
                            <span class="red" id="keyword"></span>
                        </dd>
					</dl>
                    <dl>
						<dt>기타사항</dt>
						<dd class="{{ $errors->has('etc') ? 'has-error' : '' }}">
							<textarea name="etc" id="" cols="1" rows="5" placeholder="리뷰어에게 전달할 기타 사항을 입력해주세요" class="border2">{{ old('etc') }}</textarea>
                            {!! $errors->first('etc','<span class="red">:message</span>')!!}
                            <span class="red" id="etc"></span>
						</dd>
					</dl>
				</div>
				<!-- //기본정보 입력 -->

				<div class="join_btn_wrap">
					<a class="btn" onclick="contentShow(0)">이전단계</a>
					<a class="btn black" id="second_btn">다음단계</a>
				</div>
			</div>
<!-- 오른쪽 컨텐츠 3-->
			<div class="right-content">
				<!-- 탭 -->
				<ul class="member-tab w3">
					<li><b>01</b> 기본정보 입력</li>
					<li><b>02</b> 상세정보 입력</li>
					<li class="on"><b>03</b> 결제</li>
				</ul>
				<!-- //탭 -->
				<!-- 기본정보 입력 -->
				<div style="overflow:hidden;">
					<div class="table_form2 mb20 pay">
						<dl>
							<dt class="lh120">노출옵션 선택</dt>
							<dd>
								
                                    @forelse($exposures as $exposure)
                                    <span class="pay-option">
									<input name="exposure_id" type="radio" value="{{$exposure->id}}" id="option{{$exposure->id}}"/>	
									<label for="option{{$exposure->id}}" class="expo @if($exposure->limit < count($exposure->campaignexposures)) notwork @endif">
										<h3>{{$exposure->name}}</h3>
										<p class="txt">{!!$exposure->instruction!!}</p>
                                        <p class="price"><b>+</b><b class="mm">{{number_format($exposure->price)}}</b>원</p>
									</label>
								</span>
                                    @empty
                                    노출옵션이 없습니다.
                                    @endforelse
							</dd>
						</dl>
						<dl class="bar">
							<dt class="lh120">홍보옵션 선택</dt>
							<dd>
                                @forelse($promotions as $promotion)
								<span class="pay-option">
									<input name="promotion_id" type="radio" id="poption{{$promotion->id}}" value="{{$promotion->id}}"/>	
									<label for="poption{{$promotion->id}}" class="promo @if($promotion->limit!= null && $promotion->limit < count($promotion->campaignpromotions)) notwork @endif">
										<h3>{{$promotion->name}}</h3>
										<p class="txt">{!!$promotion->instruction!!}</p>
										<p class="price"><b>+</b><b class="mm">{{number_format($promotion->price)}}</b>원</p>
									</label>
								</span>
								@empty
                                홍보옵션이 없습니다.
                                @endforelse
							</dd>
						</dl>
						<dl>
							<dt>결제내역</dt>
							<dd>
								<div class="price-list">
                                    <p>
										<span>중계수수료(모집인원X5,000원)</span>
										<span class="price"><b id="basic_price">10,000</b>원</span>
									</p>
									<p>
										<span>리뷰어 제공 포인트</span>
										<span class="price"><b id="point_price">25,000</b>원</span>
									</p>										
									<p id="exposure_price_wrap" class="hide">
										<span>노출 옵션</span>
										<span class="price"><b id="exposure_price">0</b>원</span>
									</p>
                                    <p id="promotion_price_wrap" class="hide">
										<span>홍보 옵션</span>
										<span class="price"><b id="promotion_price">0</b>원</span>
									</p>
									<p class="total-price">
										<span>합계</span>
										<span class="price"><b class="orange" id="total_price">25,000</b><span class="orange">원</span></span>
									</p>
								</div>
								<div class="price-pay">
									<p>+부가세(10%) <span id="vat">000</span>원</p>
									<p class="txt">총 결제금액</p>
									<p class="price"><b id="final_price">50,000</b>원</p>
                                    <input type="hidden" name="payment">
								</div>
							</dd>
						</dl>
                        <dl>
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
						<dl>
							<dt>결제방법</dt>
							<dd class="mt10">					
								<span class="input-button"><input name="pay_method" type="radio" id="pay1" value="card" checked><label for="pay1">신용카드</label></span>
								<span class="input-button"><input name="pay_method" type="radio" id="pay2" value="trans"><label for="pay2">실시간계좌이체</label></span>
								<span class="input-button"><input name="pay_method" type="radio" id="pay3" value="vbank"><label for="pay3">가상계좌</label></span>
							</dd>
						</dl>
					</div>
					<p class="{{ $errors->has('provide_agreement') ? 'has-error' : '' }} fl-r"><span class="input-button mr0"><input type="hidden" value="0" name="provide_agreement" /><input type="checkbox" value="1" id="checkAgree1" name="provide_agreement" @if(old('provide_agreement')!==null) checked @endif><label for="checkAgree1">개인정보 제3자 제공에 동의합니다.</label></span></p>
				</div>
				<!-- //기본정보 입력 -->

				<div class="join_btn_wrap mt30">
					<a class="btn" onclick="contentShow(1)">이전단계</a>
                    
<!--					<button type="submit" class="btn black">결제진행</button>-->
                    <button type="button" id="store_c" class="btn black">결제진행</button>
				</div>
		</div>
</form>
<!-- popup : 브랜드추가 -->
        <a href="#" class="overlay" id="add_brand"></a>
        <div class="popup h350">
			<div class="text2">
                <form>
                <p class="input">
                    <span class="brand">브랜드명</span>
                <input type="text" name="brand_name" placeholder="브랜드명" value="{{old('brand_name')}}">
                {!! $errors->first('brand_name','<span class="red">:message</span>')!!}
                <span class="brand">브랜드카테고리</span>
					<select name="category_id">
                                @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('category_id','<span>:message</span>')!!}
				</p>
                    <div id="text"></div>
				<a class="btn h46 w125" href="#close">취소</a>
                    <button class="btn black h46 w125" id="brand_submit">추가</button>
                    </form>
			</div>
            <a class="close" href="#close"></a>
        </div>
		<!-- //popup : 브랜드추가 -->
<!--브랜드 삭제 불가-->
@component('help.popup_ok')
    @slot('goId')
        brand_cant_del
    @endslot
    진행중 캠페인에 사용중인 브랜드는 삭제 할 수 없습니다.
@endcomponent
<!--브랜드 삭제 완료-->
@component('help.popup_ok')
    @slot('goId')
        brand_del_ok
    @endslot
    삭제되었습니다.
@endcomponent
<!--개인정보 제3자 제공-->
@component('help.pop_requir')
    개인정보 제3자 제공
@endcomponent
 <!-- iamport.payment.js -->
  <script type="text/javascript" src="https://cdn.iamport.kr/js/iamport.payment-1.1.5.js"></script>
<script>
    
    
    //    content보기 설정
    $(function(){
        contentShow(0);
    });
    
//    폼 전송 전 체크
    $('button[type=submit]').click(function(){
       if($('#checkAgree1').is(':checked')) {
           return true;
       } else {
           window.location.hash = "#popup_requir";
           return false;
       }
    });
    var use_point = 0;
    var total = 0;
    function contentShow(now){
        $('.right-content').css({
            height:0
        }).eq(now).removeAttr('style');
        if(now==2){
            var pp = $('input[name=offer_point]').val()*$('input[name=recruit_number]').val();
            var bp = $('input[name=recruit_number]').val() * 5000;
            $('#point_price').html(money(pp));
            $('#basic_price').html(money(bp));
            totalprice();
        }
    };
//    -----content보기 설정 끝
//    노출옵션선택
    $('.expo:not(.notwork)').click(function(e){
        e.preventDefault();
        if($(this).prev().is(':checked')){
            $(this).prev().prop('checked', false);
            $('#exposure_price').html(0);
            $('#exposure_price_wrap').addClass('hide');
        }else {
            $(this).prev().prop('checked', true);
            var ep = $(this).find('.price').children('.mm').html();
            $('#exposure_price_wrap').removeClass('hide');
            $('#exposure_price').html(ep);
        }
        totalprice();
    });
//    ----------노출옵션선택
    //    홍보옵션선택
    $('.promo').click(function(e){
        e.preventDefault();
        if($(this).prev().is(':checked')){
            $(this).prev().prop('checked', false);
            $('#promotion_price').html(0);
            $('#promotion_price_wrap').addClass('hide');
        }else {
            $(this).prev().prop('checked', true);
            var ep = $(this).find('.price').children('.mm').html();
            $('#promotion_price_wrap').removeClass('hide');
            $('#promotion_price').html(ep);
        }
        totalprice();
    });
//    ----------홍보옵션선택
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
       total = notmoney($('#basic_price').html())+notmoney($('#point_price').html())+notmoney($('#exposure_price').html())+notmoney($('#promotion_price').html());
        var vat = (total-use_point)*0.1;
        var final = (total-use_point)+vat;
        $('#total_price').html(money((total-use_point)));
        $('#vat').html(money(vat));
        $('#final_price').html(money(final));
        $('input[name=payment]').val(final);
    }
//    --------결제총합
    
//    방문재택선택
    $('input[name=form]').change(function(){
       if($('input[name=form]:checked').val()=='v'){
           $('#visit_only').removeAttr('style');
       } else{
           $('#visit_only').css({
               height:0
           })
       }
    });
    
    
//    일정지정
    var endD;
    var pickD;
    var endS;
    $('input[name=start_recruit]').change(function(){
        endD = dateAdd($(this).val(), +7);
        $('input[name=end_recruit]').attr({
            value:endD,
            min:endD
        }).trigger('change');
    });
    $('input[name=end_recruit]').change(function(){
        pickD = dateAdd($('input[name=end_recruit]').val(), +1);
        $('#pickday').html(pickD);
        $('#submit_start').html(dateAdd(pickD,+1));
        endS = dateAdd(pickD,+15);
        $('input[name=end_submit]').attr({
            value:endS,
            min:endS
        }).trigger('change');
    });
    $('input[name=end_submit]').change(function(){
        $('#fin').html(dateAdd($('input[name=end_submit]').val(), +1));
    });
//    -----일정지정끝
    

    
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
       } 
    });
//    첫번째페이지오류검사
    $('#first_btn').on('click', function(e){
       e.preventDefault();
        var name = $("input[name=name]").val();
        var brand_id = $("select[name=brand_id]").val();
        var form = $("input[name=form]:checked").val();
        var recruit_number = $("input[name=recruit_number]").val();
        var offer_point = $("input[name=offer_point]").val();
        var offer_goods = $("input[name=offer_goods]").val();
        var channel_id = $("input[name=channel_id]:checked").val();
        var start_recruit = $("input[name=start_recruit]").val();
        var end_recruit = $("input[name=end_recruit]").val();
        var end_submit = $("input[name=end_submit]").val();
        $.ajax({
           type:"POST",
           url:"{{ route('campaigns.firststore') }}",
           data:{
               name:name,
               brand_id:brand_id,
               form:form,
               recruit_number:recruit_number,
               offer_point:offer_point,
               offer_goods:offer_goods,
               channel_id:channel_id,
               start_recruit:start_recruit,
               end_recruit:end_recruit,
               end_submit:end_submit
           },
           success:function(data){
               $('span').filter('.red').html('');
                contentShow(data.now);
          },
            error: function(data) {
                if(data.status==422){
                    $('span').filter('.red').html('');
                    $.each(data.responseJSON.errors, function (i, error) {
                        var el = $('.red').filter('#'+i);
                        el.html(error[0]);
                    });
                  }
               }
        });
    });
//    -------첫번째페이지오류검사 끝
    
    //    이미지업로드바로보기
    $('input[name=main_image]').change(function(e){
       e.preventDefault();
        $('label[for=file]').css({
                   backgroundImage:"url('"+ URL.createObjectURL(event.target.files[0])+"')"
               });
         });
        //-----이미지업로드바로보기
    
    // 캠페인 지역 선택
    $('#regions').change(function(e){
       e.preventDefault();
        var now = $(this).val();
        if(now!='선택'){
        var $data = new FormData();
        $data.append('region', now);
        $.ajax({
        type: 'POST',
        url: "{{ route('campaigns.makearea') }}",
        data: $data,
        success: function(data) {
            var obj = data.areas;
            $('#areas').removeClass('hide');
            var your_html = "";
            $.each(obj, function (key, val) {
                your_html += "<option value='"+val.id+"'>" +  val.name + "</option>"
            });
         $("#areas").html(your_html) 
        },
        error: function(data) {
        },
        processData: false,
        contentType: false
            });
        } else {
            $('#areas').addClass('hide');
            $('#areas').val('');
        }
        
    });
    // ------캠페인 지역 선택
       
        
        //    두번째페이지오류검사
    $('#second_btn').on('click', function(e){
       e.preventDefault();
var $data = new FormData();
        $data.append('main_image', $("input[name=main_image]").val());
        $data.append('visit_time', $("input[name=visit_time]").val());
        $data.append('contact', $("input[name=contact]").val());
        $data.append('mission', $("textarea[name=mission]").val());
        $data.append('keyword', $("input[name=keyword]").val());
        $data.append('address', $("input[name=address]").val());
        $data.append('area_id', $("select[name=area_id]").val());
        $data.append('form', $("input[name=form]:checked").val());
    $.ajax({
        type: 'POST',
        url: "{{ route('campaigns.secondstore') }}",
        data: $data,
        success: function(data) {
            $('span').filter('.red').html('');
                contentShow(data.now);
//               $('label[for=file]').css({
//                   backgroundImage:"url('../files/"+data.img+"')"
//               })
        },
        error: function(data) {
            if(data.status==422){
                    $('span').filter('.red').html('');
                    $.each(data.responseJSON.errors, function (i, error) {
                        var el = $('.red').filter('#'+i);
                            el.html(error[0]);
                    });
                  }
        },
        processData: false,
        contentType: false
    });
    });
//    -------두번째페이지오류검사 끝
        
    //결제연동
    var IMP = window.IMP; // 생략해도 괜찮습니다.
  IMP.init("imp81498957");
    
    // IMP.request_pay(param, callback) 호출
    function request_pay(m_uid){
        IMP.request_pay({ // param
            pg: "danal_tpay",
            pay_method: $('input[name=pay_method]:checked').val(),
            merchant_uid: m_uid,
            name: $('input[name=name]').val(),
            amount: $('input[name=payment]').val(),
            buyer_email: "{{ $user->email }}",
            buyer_name: "{{ $user->name }}",
            buyer_tel: "{{ $user->mobile_num }}",
        }, function (rsp) { // callback
            if (rsp.success) {
                // 결제 성공 시 로직,
                $.ajax({
                    type: 'POST',
                    url: "{{ route('campaigns.complate') }}",
                    headers: { "Content-Type": "application/json" },
                    data: {
                        imp_uid: rsp.imp_uid,
                        m_uid: m_uid
                    },
                }).done(function(data) {
                    if(data.now){
                    window.location.href = "{{ route('campaigns.storeend') }}";
                    } else {
                        alert('결제에 오류가 있습니다. 고객센터로 연락주세요.')
                    }
                });
            } else {
                // 결제 실패 시 로직,
                var msg = '결제에 실패하였습니다.';
                msg += '에러내용 : ' + rsp.error_msg;
                alert(msg);
            }
        });
      }     
      //****ajax 최종 저장
        $('#store_c').on('click', function(e){
       e.preventDefault();
            if($('#checkAgree1').is(':checked')) {
           var s_data = new FormData($("#test_form")[0]);
    $.ajax({
        type: 'POST',
        url: "{{ route('campaigns.store_c') }}",
        data: s_data,
        success: function(data) {
            $('span').filter('.red').html('');
            if($('input[name=payment]').val()>0){
            request_pay(data.m_uid);
                } else {
                    window.location.href = "{{ route('campaigns.storeend') }}";
                }
        },
        error: function(data) {
            if(data.status==422){
                    $('span').filter('.red').html('');
                    $.each(data.responseJSON.errors, function (i, error) {
                        var el = $('.red').filter('#'+i);
                            el.html(error[0]);
                    });
                  }
        },
        processData: false,
        contentType: false
    });
       } else {
           window.location.hash = "#popup_requir";
           return false;
       }
            
    });
// 브랜드 삭제관련
    $('#del_brand').on('click', function(e){
       e.preventDefault();
        $.ajax({
           type:"POST",
           url:"{{ route('campaigns.brandCheck') }}",
           data:{brand_id: $("select[name=brand_id]").val()},
           success:function(data){
               if(data.b_result){
                   window.location.hash = '#brand_cant_del';
               } else{
                   $('#brand_select').html(data.finhtml);
                   window.location.hash = '#brand_del_ok';
               }
           },
            error: function(data) {
                alert('브랜드 삭제에 문제가 있습니다.');
               }
        });
    });
    
//    브랜드추가관련
    $('#brand_submit').on('click', function(e){
       e.preventDefault();
        var brand_name = $("input[name=brand_name]").val();
        var category_id = $("select[name=category_id]").val();
        $.ajax({
           type:"POST",
           url:"{{ route('campaigns.brandstore') }}",
           data:{brand_name:brand_name, category_id:category_id},
           success:function(data){
         $('#brand_select').html(data.finhtml);
                window.location.hash = '';
          },
            error: function(data) {
                if(data.status==422){
                    $.each(data.responseJSON.errors, function (i, error) {
                        var el = $(document).find('[name="'+i+'"]');
                        el.after($('<span class="red">'+error[0]+'</span>'));
                    });
                  }
               }
        });
    });
</script>
@include('help.addjs')	
@include('help.money')	
@include('advertisers.advertiser_leftmenu_tail')
@endsection