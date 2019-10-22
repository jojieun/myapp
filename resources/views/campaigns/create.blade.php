@extends('layouts.main')
@section('content')
@include('layouts.advertiser_leftmenu')	
<? $opbrand_id = Request::get('opbrand_id') ?>
<form action="{{ route('campaigns.store') }}" method="post" class="form__auth">
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
					<div class="select-style01 mb20">
						<select name="" type="text" id="">
							@forelse($campaigns as $campaign)
							<option value="{{ $campaign->id }}">[{{ $campaign->updated_at }}] {{ $campaign->name }}</option>		
                                     @empty
							<option value="">이전 캠페인이 없습니다</option>
                                     @endforelse
						</select>
					</div>
					<!-- //이전 캠페인 불러오기 -->
					<div class="table_form2">
						<dl>
							<dt>브랜드선택</dt>
							<dd class="{{ $errors->has('brand_id') ? 'has-error' : '' }}">
								<div class="new-brand" style="overflow:hidden;">
									<select name="brand_id" type="text" id="">
                                        @forelse($brands as $brand)
										<option value="{{ $brand->id }}" @if( $brand->id == old('brand_id') || $brand->id == $opbrand_id ) selected @endif>[{{ $brand->category->name }}] {{ $brand->name }}</option>		
                                        @empty
										<option value="">브랜드가 없습니다</option>
                                        @endforelse
									</select>
									<a href="#add_brand" class="btn">새 브랜드 추가하기</a>
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
								<span class="input-button3"><input name="form" type="radio" id="home" value="h" @if( 'v' == old('form') ) checked @endif><label for="home">재택</label></span>
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
							<dt>제공내역<a href="#" class="btn-question"></a>
								<div class="question">
									<p>리뷰어가 포인트 출금 신청 시, 수수료 3.3%와 이체 수수료를 공제 후 지급 됩니다.</p>
								</div>
							</dt>
							<dd>
                                <div class="{{ $errors->has('offer_point') ? 'has-error' : '' }}">
								<input name="offer_point" type="text" id="" value="{{ old('offer_point') }}" placeholder=" " class="mb10" /><span class="point-add">point  x  1인</span>
                                {!! $errors->first('offer_point','<span class="red">:message</span>')!!}
                                    <span class="red" id="offer_point"></span>
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
							<dt>캠페인 일정<a href="#" class="btn-question"></a>
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
						<dt class="lh120">캠페인<br/>대표이미지</dt>
						<dd class="{{ $errors->has('main_image') ? 'has-error' : '' }}">
							<div class="file-area">
								<span class="upload">
									<label for="file">									
										<input name="main_image" type="file" id="file" value="{{ old('main_image') }}" placeholder="상세이미지" class="full_width mb10" />	
									</label>
								</span>
								<span class="add-txt">※ 대표이미지는 530*530 이상 정육면체 사이즈로 작업하여 업로드해주세요.</span>
                                <span class="red"></span>
							</div>
                            {!! $errors->first('main_image','<span class="red">:message</span>')!!}
						</dd>
					</dl>
                    <script>
//                        $('input[name=main_image]').change(function(){
//                        alert(this.files[0]);
//                           $('label[for=file]').css({
//                               backgroundImage: 'url('+this.files[0]+')'
//                           });
//                        });
                    </script>
                    
					<dl class="bar">
						<dt class="lh120">상세이미지<br/><small>(선택사항)</small></dt>
						<dd class="">
							<div class="file-area">
								<span class="upload2 {{ $errors->has('detail_image1') ? 'has-error' : '' }}">
									<label for="file1"><input name="detail_image1" type="file" id="file1" value="{{ old('detail_image1') }}" placeholder="상세이미지" class="mb10" /></label>
                                    {!! $errors->first('detail_image1','<span class="red">:message</span>')!!}
								</span>
								<span class="upload2 {{ $errors->has('detail_image2') ? 'has-error' : '' }}">
									<label for="file2"><input name="detail_image2" type="file" id="file2" value="{{ old('detail_image2') }}" placeholder="상세이미지" class="mb10" /></label>
                                    {!! $errors->first('detail_image2','<span class="red">:message</span>')!!}
								</span>
								<span class="upload2 {{ $errors->has('detail_image3') ? 'has-error' : '' }}">
									<label for="file3"><input name="detail_image3" type="file" id="file3" value="{{ old('detail_image3') }}" placeholder="상세이미지" class="mb10" /></label>
                                    {!! $errors->first('detail_image3','<span class="red">:message</span>')!!}
								</span>
							</div>
						</dd>
					</dl>
					<dl>
						<dt>방문가능 시간</dt>
						<dd class="{{ $errors->has('visit_time') ? 'has-error' : '' }}">
                            <input name="visit_time" type="text" id="" value="{{ old('visit_time') }}" placeholder="예) 평일 10:00~17:00" class="full_width" />
                        {!! $errors->first('visit_time','<span class="red">:message</span>')!!}
                        </dd>
					</dl>
					<dl>
						<dt>주소</dt>
						<dd class="{{ $errors->has('detail_address') ? 'has-error' : '' }} {{ $errors->has('address') ? 'has-error' : '' }}">
							<input name="address" type="text" id="" placeholder="주소" class="w150 mb10" value="{{ old('address') }}"/><button type="button" name="button" class="btn btn-check">주소검색</button>
							<input name="detail_address" type="text" id="" placeholder="상세주소" class="full_width" value="{{ old('detail_address') }}" />
                            {!! $errors->first('address','<span class="red">:message</span>')!!}
                            {!! $errors->first('detail_address','<span class="red">:message</span>')!!}
						</dd>
					</dl>
					<dl class="bar">
						<dt>담당자 연락처</dt>
						<dd class="{{ $errors->has('contact') ? 'has-error' : '' }}"><input name="contact" type="text" id="" value="{{ old('contact') }}" placeholder="선정된 리뷰어에게만 공개됩니다." class="full_width" /></dd>
                        {!! $errors->first('contact','<span class="red">:message</span>')!!}
					</dl>
					<dl>
						<dt>리뷰미션</dt>
						<dd class="{{ $errors->has('mission') ? 'has-error' : '' }}">
							<textarea name="mission" id="" cols="1" rows="5" placeholder="리뷰어에게 전달할 캠페인 상세 미션과 요청사항을 입력해주세요" class="border2">{{ old('mission') }}</textarea>
                            {!! $errors->first('mission','<span class="red">:message</span>')!!}
						</dd>
					</dl>
					<dl>
						<dt>리뷰키워드</dt>
						<dd class="{{ $errors->has('keyword') ? 'has-error' : '' }}"><input name="keyword" type="text" id="" value="{{ old('keyword') }}" placeholder="리뷰어가 리뷰 작성시 사용할 키워드 또는 해시태그를 입력해주세요" class="full_width" />
                        {!! $errors->first('keyword','<span class="red">:message</span>')!!}
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
								<span class="pay-option">
									<input name="" type="radio" id="option1" value="" />	
									<label for="option1">
										<h3>플래티넘</h3>
										<p class="txt">체험단 캠페인이 <span class="point">최상단에 노출</span>되어 다른 캠페인보다 더욱 많이 노출됩니다.</p>
										<p class="price"><b>+00,000</b>원</p>
									</label>
								</span>
								<span class="pay-option">
									<input name="" type="radio" id="option2" value="" />	
									<label for="option2">
										<h3>프라임</h3>
										<p class="txt">체험단 캠페인이 <span class="point">상단에 노출</span>되어 다른 캠페인보다 더욱 많이 노출됩니다.</p>
										<p class="price"><b>+00,000</b>원</p>
									</label>
								</span>
								<span class="pay-option">
									<input name="" type="radio" id="option3" value="" />	
									<label for="option3">
										<h3>그랜드</h3>
										<p class="txt">체험단 캠페인이 <span class="point">중단에 노출</span>되어 다른 캠페인보다 더욱 많이 노출됩니다.</p>
										<p class="price"><b>+00,000</b>원</p>
									</label>
								</span>
							</dd>
						</dl>
						<dl class="bar">
							<dt class="lh120">홍보옵션 선택</dt>
							<dd>
								<span class="pay-option">
									<input name="" type="radio" id="option4" value="" />	
									<label for="option4">
										<h3>홍보배너게재</h3>
										<p class="txt">사이트 최상단에 홍보 배너를 게재합니다.<br/>(블록션 디자이너가 배너 제작에 대한 내용을 연락드립니다.)</p>
										<p class="price"><b>+00,000</b>원</p>
									</label>
								</span>
								<span class="pay-option">
									<input name="" type="radio" id="option5" value="" />	
									<label for="option5">
										<h3>푸시 알림</h3>
										<p class="txt">추천되는 인플루언서 회원 100명에게 푸시 알림을 보내드립니다.</p>
										<p class="price"><b>+00,000</b>원</p>
									</label>
								</span>
							</dd>
						</dl>
						<dl>
							<dt>결제내역</dt>
							<dd>
								<div class="price-list">
									<p>
										<span>리뷰어 제공 포인트</span>
										<span class="price"><b>25,000</b>원</span>
									</p>										
									<p>
										<span>프라임 노출 옵션</span>
										<span class="price"><b>25,000</b>원</span>
									</p>										
									<p class="total-price">
										<span>합계</span>
										<span class="price"><b class="orange">25,000</b><span class="orange">원</span></span>
									</p>
								</div>
								<div class="price-pay">
									<p>+부가세(10%) 000원</p>
									<p class="txt">총 결제금액</p>
									<p class="price"><b>50,000</b>원</p>
								</div>
							</dd>
						</dl>
						<dl>
							<dt>결제내역</dt>
							<dd class="mt10">						
								<span class="input-button"><input name="" type="radio" id="pay1"><label for="pay1">신용카드</label></span>
								<span class="input-button"><input name="" type="radio" id="pay2"><label for="pay2">실시간계좌이체</label></span>
								<span class="input-button"><input name="" type="radio" id="pay3"><label for="pay3">결제내역통장카드</label></span>
							</dd>
						</dl>
					</div>
					<p class="{{ $errors->has('') ? 'has-error' : '' }} fl-r"><span class="input-button mr0"><input type="checkbox" id="checkAgree1" name=""><label for="checkAgree1">개인정보 제3자 제공에 동의합니다.</label></span></p>
				</div>
				<!-- //기본정보 입력 -->

				<div class="join_btn_wrap mt30">
					<a href="client_0102.php" class="btn">이전단계</a>
					<a href="client_0104.php" class="btn black">결제진행</a>
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
		<!-- //popup : 비밀번호 재설정 -->


@include('layouts.advertiser_leftmenu_tail')
<script>
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
    
//    content보기 설정
    $(function(){
        contentShow(1);
    });
    
    function contentShow(now){
        $('.right-content').css({
            height:0
        }).eq(now).removeAttr('style');
    };
//    -----content보기 설정 끝
    
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
    
    //    두번째페이지오류검사
    $('input[name=main_image]').change(function(e){
       e.preventDefault();
        var main_image = $("input[name=main_image]").val();
        $.ajax({
           type:"POST",
           url:"{{ route('campaigns.secondstore') }}",
           data:{
               main_image:main_image
           },
           success:function(data){
               alert(data.img);
               $('label[for=file]').css({
                   backgroundImage:'url('+data.img+')'
               })
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
//    -------두번째페이지오류검사 끝
    
//    브랜드추가관련
    $('#brand_submit').on('click', function(e){
       e.preventDefault();
        var brand_name = $("input[name=brand_name]").val();
        var category_id = $("select[name=category_id]").val();
        $.ajax({
           type:"POST",
           url:"{{ route('campaigns.brandstore') }}",
           data:{brand_name:brand_name, category_id:category_id},
           success:function(response){
          window.location.replace(response);
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
@endsection