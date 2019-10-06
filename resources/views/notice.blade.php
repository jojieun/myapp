@extends('layouts.main')

@section('content')

<span class="m-bar2"></span>
	<div class="sub-container bt-ddd">
		<!-- //탭-->
	
		<!-- 상세 컨텐츠내용 -->
		<div class="content-in-sub">
            <!-- 왼쪽메뉴 -->
			@include('layouts.leftmenu')
						
			<!-- 오른쪽 컨텐츠 -->
			<div class="right-content">
				<h2>공지사항</h2>

				<div class="board_navi_box list">				
					<span class="search"><input name="" type="text" placeholder="검색어를 입력해주세요"><a href="#"><img src="/img/common/ico_search.gif" alt="검색"></a></span>
					<!--a href="notice_write.php" class="btn_type">글쓰기</a-->
				</div>
				<!-- 여기부터 게시판 목록 테이블폼입니다. -->
				<form>
					<div  class="table_default notice">
						<div class="table_th">
							<p class="list_num">번호</p>
							<p class="list_subj">제목</p>
							<p class="list_date">등록일</p>
						</div>
						<div class="table_td">
							<div class="table_td_line">
								<p class="list_num">1</p>
								<p class="list_subj"><a href="notice_view.php" onClick="#"><span class="new">블록션 공지사항입니다.</span></a></p>
								<p class="list_date">2019-07-10</p>
							</div>
						</div>
						<div class="table_td">
							<div class="table_td_line">
								<p class="list_num">2</p>
								<p class="list_subj"><a href="notice_view.php" onClick="#"><span class="new">블록션 공지사항입니다.</span></a></p>
								<p class="list_date">2019-07-10</p>
							</div>
						</div>
						<div class="table_td">
							<div class="table_td_line">
								<p class="list_num">3</p>
								<p class="list_subj"><a href="notice_view.php" onClick="#"><span class="new">블록션 공지사항입니다.</span></a></p>
								<p class="list_date">2019-07-10</p>
							</div>
						</div>
						<div class="table_td">
							<div class="table_td_line">
								<p class="list_num">4</p>
								<p class="list_subj"><a href="notice_view.php" onClick="#"><span class="new">블록션 공지사항입니다.</span></a></p>
								<p class="list_date">2019-07-10</p>
							</div>
						</div>
						<div class="table_td">
							<div class="table_td_line">
								<p class="list_num">5</p>
								<p class="list_subj"><a href="notice_view.php" onClick="#">블록션 공지사항입니다.</a></p>
								<p class="list_date">2019-07-10</p>
							</div>
						</div>
						<div class="table_td">
							<div class="table_td_line">
								<p class="list_num">6</p>
								<p class="list_subj"><a href="notice_view.php" onClick="#">블록션 공지사항입니다.</a></p>
								<p class="list_date">2019-07-10</p>
							</div>
						</div>
						<div class="table_td">
							<div class="table_td_line">
								<p class="list_num">7</p>
								<p class="list_subj"><a href="notice_view.php" onClick="#">블록션 공지사항입니다.</a></p>
								<p class="list_date">2019-07-10</p>
							</div>
						</div>
						<div class="table_td">
							<div class="table_td_line">
								<p class="list_num">8</p>
								<p class="list_subj"><a href="notice_view.php" onClick="#">블록션 공지사항입니다. 블록션 공지사항입니다.</a></p>
								<p class="list_date">2019-07-10</p>
							</div>
						</div>
					</div>	
				</form>

				<!-- 페이지 위치, 글쓰기 -->
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
				<!-- //페이지 위치, 글쓰기 -->
				<!-- 여기까지 게시판 테이블폼입니다. -->

			</div>				
		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>


@endsection