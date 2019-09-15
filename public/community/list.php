<?
	include $_SERVER['DOCUMENT_ROOT']. '/head.php';
?>

	<span class="m-bar2"></span>
	<div class="sub-container bt-ddd">
		<!-- //탭-->
	
		<!-- 상세 컨텐츠내용 -->
		<div class="content-in-sub">

			<h2>커뮤니티</h2>
			
			<div class="board_navi_box list">				
				<span class="search"><input name="" type="text" placeholder="검색어를 입력해주세요"><a href="#"><img src="/img/common/ico_search.gif" alt="검색"></a></span>
				<a href="write.php" class="btn_type">글쓰기</a>
			</div>
			<!-- 여기부터 게시판 목록 테이블폼입니다. -->
			<form>
				<div  class="table_default">
					<div class="table_th">
						<p class="list_subj">제목</p>
						<p class="list_writer">작성자</p>
						<p class="list_date">작성일</p>
						<p class="list_count">조회수</p>
					</div>
					<div class="table_td">
						<div class="table_td_line">
							<p class="list_subj"><a href="view.php" onClick="#"><span class="new">[블로그] 요즘 블로그 반영에 대한 견해, 그리고 반영 확인법</span></a></p>
							<p class="list_writer">조조</p>
							<p class="list_date">2019-07-10 11:50</p>
							<p class="list_count">120</p>
						</div>
						<div class="table_td_line">
							<p class="list_subj"><a href="view.php" onClick="#"><span class="new">[블로그] 요즘 블로그 반영에 대한 견해, 그리고 반영 확인법</span></a></p>
							<p class="list_writer">조조</p>
							<p class="list_date">2019-07-10 11:50</p>
							<p class="list_count">120</p>
						</div>
						<div class="table_td_line">
							<p class="list_subj"><a href="view.php" onClick="#"><span class="new">[블로그] 요즘 블로그 반영에 대한 견해, 그리고 반영 확인법</span></a></p>
							<p class="list_writer">조조</p>
							<p class="list_date">2019-07-10 11:50</p>
							<p class="list_count">120</p>
						</div>
						<div class="table_td_line">
							<p class="list_subj"><a href="view.php" onClick="#"><span class="new">[블로그] 요즘 블로그 반영에 대한 견해, 그리고 반영 확인법</span></a></p>
							<p class="list_writer">조조</p>
							<p class="list_date">2019-07-10 11:50</p>
							<p class="list_count">120</p>
						</div>
						<div class="table_td_line">
							<p class="list_subj"><a href="view.php" onClick="#"><span class="new">[블로그] 요즘 블로그 반영에 대한 견해, 그리고 반영 확인법</span></a></p>
							<p class="list_writer">조조</p>
							<p class="list_date">2019-07-10 11:50</p>
							<p class="list_count">120</p>
						</div>
						<div class="table_td_line">
							<p class="list_subj"><a href="view.php" onClick="#"><span class="new">[블로그] 요즘 블로그 반영에 대한 견해, 그리고 반영 확인법</span></a></p>
							<p class="list_writer">조조</p>
							<p class="list_date">2019-07-10 11:50</p>
							<p class="list_count">120</p>
						</div>
						<div class="table_td_line">
							<p class="list_subj"><a href="view.php" onClick="#"><span class="new">[블로그] 요즘 블로그 반영에 대한 견해, 그리고 반영 확인법</span></a></p>
							<p class="list_writer">조조</p>
							<p class="list_date">2019-07-10 11:50</p>
							<p class="list_count">120</p>
						</div>
						<div class="table_td_line">
							<p class="list_subj"><a href="view.php" onClick="#"><span class="new">[블로그] 요즘 블로그 반영에 대한 견해, 그리고 반영 확인법</span></a></p>
							<p class="list_writer">조조</p>
							<p class="list_date">2019-07-10 11:50</p>
							<p class="list_count">120</p>
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
		<!-- //상세 컨텐츠내용 -->	
	</div>

<?
	include $_SERVER['DOCUMENT_ROOT']. '/tail.php';
?>