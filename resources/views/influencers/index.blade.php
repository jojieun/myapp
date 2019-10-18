@extends('layouts.main')
@section('content')
<div class="sub-container bt-ddd">

		<!-- 상단 카테고리 필터 -->
		<section class="content-in-top2">
			<div class="list_title">
				<h2>인플루언서</h2>
				<div class="map">
					<a href="#" class="btn-map">지역전체</a>
					<div class="map-on">&nbsp;</div>
				</div>
			</div>
			<div class="category">
				<dl>
					<dt>활동채널</dt>
					<dd>
						<span class="input-button2"><input name="" type="checkbox" id="channel01"><label for="channel01">전체</label></span>
						<span class="input-button2"><input name="" type="checkbox" id="channel02"><label for="channel02">네이버블로그</label></span>
						<span class="input-button2"><input name="" type="checkbox" id="channel03"><label for="channel03">인스타그램</label></span>
						<span class="input-button2"><input name="" type="checkbox" id="channel04"><label for="channel04">유튜브</label></span>
						<span class="input-button2"><input name="" type="checkbox" id="channel05"><label for="channel05">기타</label></span>
					</dd>
				</dl>
				<dl>
					<dt>카테고리</dt>
					<dd>
						<span class="input-button"><input name="" type="checkbox" id="category01"><label for="category01">전체</label></span>
						<span class="input-button"><input name="" type="checkbox" id="category02"><label for="category02">맛집</label></span>
						<span class="input-button"><input name="" type="checkbox" id="category03"><label for="category03">뷰티</label></span>
						<span class="input-button"><input name="" type="checkbox" id="category04"><label for="category04">숙박</label></span>
						<span class="input-button"><input name="" type="checkbox" id="category05"><label for="category05">문화</label></span>
						<span class="input-button"><input name="" type="checkbox" id="category06"><label for="category06">기타</label></span>				
					</dd>
				</dl>
			</div>
		</section>	
		<!-- //상단 카테고리 필터 -->
		
		<section class="content-in-sub mt30">

			<!-- 검색 -->
			<div class="board_navi_box list">				
				<span class="search mr0">
					<input name="" type="text" placeholder="검색어를 입력해주세요"><a href="#"><img src="/img/common/ico_search.gif" alt="검색"></a>
				</span>
			</div>
			<!-- //검색 -->
			<!-- 여기부터 게시판 목록 테이블폼입니다. -->
			<form>
				<div  class="table_default pd28">
					<div class="table_th">
						<p class="list_name">이름</p>
						<p class="list_info">정보요약</p>
						<p class="list_update">업데이트</p>
					</div>
                    @for($i=0; $i<10; $i++)
					<div class="table_td">
						<a href="{{route('influencers.show')}}">
							<div class="table_td_line">
								<p class="list_name"><span>조○○</span>조조</p>
								<p class="list_info">
									<span class="title">사진 전공자가 만드는 고퀄리티 리뷰</span>
									<span class="txt">부산, 경남  |  맛집, 문화, 기타</span>
									<span class="sns"><span class="blog">네이버블로그</span><span class="insta">인스타그램</span></span>
								</p>
								<p class="list_update"><span class="pc-none-770">업데이트 : &nbsp;</span>5분 전</p>
							</div>
						</a>
					</div>
                @endfor
					
				</div>	
			</form>

			<!-- 페이지 위치 -->
			<div id="pagination_area">
				<ul class="pagination">
					<li class="prev"><a href="#">prev</a></li>
					<li class="listpage_num"><b>1</b></li>
					<li class="listpage_num"><a href= "#" class="page">2</a></li>					
					<li class="listpage_num"><a href= "#" class="page">3</a></li>					
					<li class="listpage_num"><a href= "#" class="page">4</a></li>					
					<li class="listpage_num"><a href= "#" class="page">5</a></li>
					<li class="next"><a href="#">next</a></li>
				</ul>
			</div>
			<!-- //페이지 위치 -->
			<!-- 여기까지 게시판 테이블폼입니다. -->

		</section>
	</div>
@endsection