<?
	include $_SERVER['DOCUMENT_ROOT']. '/head.php';
?>
	<span class="m-bar2"></span>
	<div class="sub-container bt-ddd">
	
		<!-- 상세 컨텐츠내용 -->
		<div class="content-in-sub">
			
			<h2>커뮤니티</h2>

		<!-- 여기부터 게시판 글쓰기 테이블폼입니다. -->
		<form>
			<div class="table_default write">
				<div class="table_td">
					<div class="table_td_line">
						<input name="" type="text" id="" value="" placeholder="제목을 입력해주세요." class="full_width" />
					</div>
					<div class="table_td_line">						
						<textarea name="" rows="7" id="" placeholder="내용을 입력해주세요." class="full_width" ></textarea>
					</div>
				</div>
			</div>

			<div class="board_navi_box write">				
				<a href="list.php" class="btn_type btn_border">취소하기</a>
				<a href="#" class="btn_type">등록하기</a>
			</div>

		</form>
		<!-- 여기까지 게시판 글쓰기 테이블폼입니다. -->
				
		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>

<?
	include $_SERVER['DOCUMENT_ROOT']. '/tail.php';
?>