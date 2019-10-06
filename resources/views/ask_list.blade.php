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
				<h2>문의내역</h2>

				<div class="board_navi_box list">
					<a href="ask.php" class="btn_type">1:1 문의하기</a>
				</div>
				<!-- 여기부터 게시판 목록 테이블폼입니다. -->
				<form>
					<div  class="table_default ask">
						<div class="table_th">
							<p class="list_subj">문의제목</p>
							<p class="list_date">문의날짜</p>
							<p class="list_comment">답변여부</p>
						</div>
						<div class="table_td">
							<div class="table_td_line">
								<p class="list_subj"><a href="ask_view.php" onClick="#">궁금궁금합니다</a></p>
								<p class="list_date">2019.07.19 15:10</p>
								<p class="list_comment"><a href="ask_view.php"><span class="btn_comment">미답변</span></a></p>
							</div>
						</div>
						<div class="table_td">
							<div class="table_td_line">
								<p class="list_subj"><a href="ask_view.php" onClick="#">궁금궁금합니다 궁금궁금합니다 궁금궁금합니다 궁금 궁금 합니다 궁금 궁금 합니다</a></p>
								<p class="list_date">2019.07.19 15:10</p>
								<p class="list_comment"><a href="ask_view.php"><span class="btn_comment yes">답변완료</span></a></p>
							</div>
						</div>
						<!--div class="table_td">
							<p class="txt-none">문의하신 내역이 없습니다.</p>
						</div-->
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