<?
	include $_SERVER['DOCUMENT_ROOT']. '/head.php';
?>
	<span class="m-bar2"></span>
	<div class="sub-container bt-ddd">
	
		<!-- 상세 컨텐츠내용 -->
		<div class="content-in-sub">
			
			<h2>커뮤니티</h2>

			<div class="board_navi_box list">			
				<a href="list.php" class="btn_type">목록으로</a>
			</div>
			<!-- 여기부터 게시판 VIEW 테이블폼입니다. -->
			<div class="table_default view">
				<div class="table_td">
					<div class="table_td_line">
						<span class="subject">[블로그] 요즘 블로그 반영에 대한 견해, 그리고 반영 확인법</span>
						<span class="date w200">조조  ｜  2019-07-10 11:50  ｜  120</span>
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
			
			<div class="board_navi_box view">
				<a href="#" class="btn_type btn_border">수정</a>
				<a href="#" class="btn_type btn_border">삭제</a>
			</div>

			<!-- 댓글 -->
			<div class="comment">
				<h3>댓글</h3>
				<p class="comment-input">
					<textarea name="" id="" cols="30" rows="10" placeholder="댓글을 등록해 주세요" class="border"></textarea>
					<a href="#">등록</a>
				</p>
				<ul class="comment-list">
					<li>
						<span class="comment-id">
							<p>테크토니</p>
							<span>2019-07-10 11:50</span>
						</span>
						<span class="comment-txt">감사합니다!! 도움이 되었어요! 감사합니다!! 도움이 되었어요! 감사합니다!! 도움이 되었어요! 감사합니다!! 도움이 되었어요! 감사합니다!! 도움이 되었어요! 감사합니다!! 도움이 되었어요!</span>
					</li>
					<li>
						<span class="comment-id">
							<p>테크토니</p>
							<span>2019-07-10 11:50</span>
						</span>
						<span class="comment-txt">감사합니다!! 도움이 되었어요!</span>
					</li>
					<li>
						<span class="comment-id">
							<p>테크토니</p>
							<span>2019-07-10 11:50</span>
						</span>
						<span class="comment-txt">감사합니다!! 도움이 되었어요!</span>
					</li>
				</ul>
			</div>
			<!-- 댓글 -->
			<!-- 여기까지 게시판 VIEW 테이블폼입니다. -->
				
		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>

<?
	include $_SERVER['DOCUMENT_ROOT']. '/tail.php';
?>