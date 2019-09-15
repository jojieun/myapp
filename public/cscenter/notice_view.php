<?
	include $_SERVER['DOCUMENT_ROOT']. '/head.php';
?>
	<span class="m-bar2"></span>
	<div class="sub-container bt-ddd">
		<!-- //탭-->
	
		<!-- 상세 컨텐츠내용 -->
		<div class="content-in-sub">
			<!-- 왼쪽메뉴 -->
			<? include $_SERVER['DOCUMENT_ROOT']. '/cscenter/leftmenu.php'; ?>
						
			<!-- 오른쪽 컨텐츠 -->
			<div class="right-content">
				<h2>공지사항</h2>

				<div class="board_navi_box list">			
					<a href="notice_list.php" class="btn_type">목록으로</a>
				</div>
				<!-- 여기부터 게시판 VIEW 테이블폼입니다. -->
				<div class="table_default view">
					<div class="table_td">
						<div class="table_td_line">
							<span class="subject">[블로그] 요즘 블로그 반영에 대한 견해, 그리고 반영 확인법</span>
							<span class="date w200">2019-07-10 11:50  ｜  120</span>
						</div>
						<div class="txt_view">
							<div class="txt_view_con">
								1. 블로그 반영 지연은 무슨 상황인가?<br/>
								정확치는 않지만, 제 생각에는 잦은 점검이 네이버 오류를 고치는 작업이 아니라<br/>
								일종의 반영 테스트일 것 같습니다. 일찌감치 네이버측에서는 업체의 가공된 글이 아니라<br/>
								순수한 리뷰나 정보성이 부각될 수 있도록 시스템을 개선해나가고 있다고 밝혔고,<br/>
								이 부분에 대한 반영 테스트가 아닐까 싶습니다.
							</div>
						</div>					
					</div>				
				</div>

			</div>				
		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>

<?
	include $_SERVER['DOCUMENT_ROOT']. '/tail.php';
?>