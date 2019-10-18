@extends('layouts.main')
@section('content')
@include('layouts.advertiser_leftmenu')	
<form action="{{ route('campaigns.store') }}" method="post" class="form__auth">
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
							<dd>
								<div class="new-brand" style="overflow:hidden;">
									<select name="brand_id" type="text" id="">
                                        @forelse($brands as $brand)
										<option value="{{ $brand->id }}">[{{ $brand->category->name }}] {{ $brand->name }}</option>		
                                        @empty
										<option value="">브랜드가 없습니다</option>
                                        @endforelse
									</select>
									<button type="button" name="" class="btn">새 브랜드 추가하기</button>
								</div>
							</dd>
						</dl>
						<dl>
							<dt>캠페인 명</dt>
							<dd class="{{ $errors->has('') ? 'has-error' : '' }}"><input name="name" type="text" id="" value="" placeholder="캠페인 이름을 입력해주세요" class="full_width" /></dd>
						</dl>						
						<dl>
							<dt>진행형태</dt>
							<dd class="{{ $errors->has('') ? 'has-error' : '' }}">
								<span class="input-button3"><input name="" type="radio" id="visit"><label for="visit">방문</label></span>
								<span class="input-button3"><input name="" type="radio" id="home"><label for="home">재택</label></span>
							</dd>
						</dl>
						<dl>
							<dt>모집인원</dt>
							<dd class="{{ $errors->has('') ? 'has-error' : '' }}">
								<div class="number">
									<button class="down"><img src="/img/common/btn_minus.gif" alt="-"></button>
									<input type="number" data-min="1" value="1" data-max="100">
									<button class="up"><img src="/img/common/btn_plus.gif" alt="+"></button>
								</div>
							</dd>
						</dl>
						<dl>
							<dt>제공내역<a href="#" class="btn-question"></a>
								<div class="question">
									<p>리뷰어가 포인트 출금 신청 시, 수수료 3.3%와 이체 수수료를 공제 후 지급 됩니다.</p>
								</div>
							</dt>
							<dd class="{{ $errors->has('') ? 'has-error' : '' }}">
								<input name="" type="text" id="" value="" placeholder=" " class="mb10" /><span class="point-add">point  x  1인</span>
								<input name="" type="text" id="" value="" placeholder="제공 물품/서비스를 입력해주세요" class="full_width mb10" />					
							</dd>
						</dl>
						<dl>
							<dt>모집채널</dt>
							<dd class="{{ $errors->has('') ? 'has-error' : '' }} mtb10">
								<span class="input-button2"><input name="" type="checkbox" id="channel01"><label for="channel01">전체</label></span>
								<span class="input-button2"><input name="" type="checkbox" id="channel02"><label for="channel02">네이버블로그</label></span>
								<span class="input-button2"><input name="" type="checkbox" id="channel03"><label for="channel03">인스타그램</label></span>
								<span class="input-button2"><input name="" type="checkbox" id="channel04"><label for="channel04">유튜브</label></span>
								<span class="input-button2"><input name="" type="checkbox" id="channel05"><label for="channel05">기타</label></span>
							</dd>
						</dl>
						<dl>
							<dt>캠페인 일정<a href="#" class="btn-question on"></a>
								<div class="question">
									<p>리뷰어 모집기간: 최소 7일<br/>리뷰 제출기간 : 최소 14일<br/>이상으로 설정해주세요!</p>
								</div>							
							</dt>
							<dd class="{{ $errors->has('') ? 'has-error' : '' }} date">
								<p>
									<span class="title">리뷰어 모집기간</span>
									<span class="txt">
										<input name="" type="text" size="20" title="시작일" class="m_mb10 input-date" /> <em>~</em>
										<input name="" type="text" size="20" title="종료일" class="m_mb10 input-date" />
									</span>
								</p>
								<p><span class="title">리뷰어 선정일</span>
									<span class="txt">2019.09.11</span>
								</p>
								<p><span class="title">리뷰 제출기간</span>
									<span class="txt">
										<span class="gray-box">2019.09.12</span> <em>~</em>
										<input name="" type="text" size="20" title="종료일" class="m_mb10 input-date" />
									</span>
								</p>
								<p><span class="title">리뷰제출 종료일</span>
									<span class="txt">2019.09.30</span>
								</p>
							</dd>
						</dl>
					</div>
				</div>
				<!-- //기본정보 입력 -->
				<div class="join_btn_wrap">
					<a href="client_0102.php" class="btn black">다음단계</a>
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
						<dd>
							<div class="file-area">
								<span class="upload">
									<label for="file">									
										<input name="" type="file" id="file" value="" placeholder="상세이미지" class="full_width mb10" />	
									</label>
								</span>
								<span class="add-txt">※ 대표이미지는 530*530 이상 정육면체 사이즈로 작업하여 업로드해주세요.</span>
							</div>
						</dd>
					</dl>
					<dl class="bar">
						<dt class="lh120">상세이미지<br/><small>(선택사항)</small></dt>
						<dd>
							<div class="file-area">
								<span class="upload2">
									<label for="file1"><input name="" type="file" id="file1" value="" placeholder="상세이미지" class="mb10" /></label>
								</span>
								<span class="upload2">
									<label for="file2"><input name="" type="file" id="file2" value="" placeholder="상세이미지" class="mb10" /></label>
								</span>
								<span class="upload2">
									<label for="file3"><input name="" type="file" id="file3" value="" placeholder="상세이미지" class="mb10" /></label>
								</span>
							</div>
						</dd>
					</dl>
					<dl>
						<dt>방문가능 시간</dt>
						<dd><input name="" type="text" id="" value="" placeholder="예) 평일 10:00~17:00" class="full_width" /></dd>
					</dl>
					<dl>
						<dt>주소</dt>
						<dd>
							<input name="" type="text" id="" placeholder="주소" class="w150 mb10"/><button type="button" name="button" class="btn btn-check">주소검색</button>
							<input name="" type="text" id="" placeholder="상세주소" class="full_width" />
						</dd>
					</dl>
					<dl class="bar">
						<dt>담당자 연락처</dt>
						<dd><input name="" type="text" id="" value="" placeholder="선정된 리뷰어에게만 공개됩니다." class="full_width" /></dd>
					</dl>
					<dl>
						<dt>리뷰미션</dt>
						<dd>
							<textarea name="" id="" cols="1" rows="5" placeholder="리뷰어에게 전달할 캠페인 상세 미션과 요청사항을 입력해주세요" class="border2"></textarea>
						</dd>
					</dl>
					<dl>
						<dt>리뷰키워드</dt>
						<dd><input name="" type="text" id="" value="" placeholder="리뷰어가 리뷰 작성시 사용할 키워드 또는 해시태그를 입력해주세요" class="full_width" /></dd>
					</dl>
				</div>
				<!-- //기본정보 입력 -->

				<div class="join_btn_wrap">
					<a href="client_0101.php" class="btn">이전단계</a>
					<a href="client_0103.php" class="btn black">다음단계</a>
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
					<p class="fl-r"><span class="input-button mr0"><input type="checkbox" id="checkAgree1" name=""><label for="checkAgree1">개인정보 제3자 제공에 동의합니다.</label></span></p>
				</div>
				<!-- //기본정보 입력 -->

				<div class="join_btn_wrap mt30">
					<a href="client_0102.php" class="btn">이전단계</a>
					<a href="client_0104.php" class="btn black">결제진행</a>
				</div>
		</div>
</form>
@include('layouts.advertiser_leftmenu_tail')
<script>
$(function(){
    
});
</script>
@endsection