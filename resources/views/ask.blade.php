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
				<h2 class="mb70">1:1 문의하기</h2>

				<!-- 여기부터 게시판 글쓰기 테이블폼입니다. -->
				<form>
					<div class="table_default write">
						<div class="table_td">
							<div class="table_td_line">
								<select name="" id="" class="full_width">
									<option value="" disabled selected style="display: none;">카테고리를 선택해주세요!</option>
									<option value="0">전체</option>
									<option value="1">맛집</option>
									<option value="2">뷰티</option>
									<option value="3">숙박</option>
									<option value="4">문화</option>
									<option value="5">기타</option>
								</select>
							</div>
							<div class="table_td_line">
								<input name="" type="text" id="" value="" placeholder="제목을 입력해주세요." class="full_width" />
							</div>
							<div class="table_td_line">						
								<textarea name="" rows="7" id="" placeholder="내용을 입력해주세요." class="full_width" ></textarea>
							</div>
						</div>
					</div>

					<div class="board_navi_box write">				
						<a href="notice_list.php" class="btn_type btn_border">취소하기</a>
						<a href="#" class="btn_type">등록하기</a>
					</div>

				</form>
				<!-- 여기까지 게시판 글쓰기 테이블폼입니다. -->

			</div>				
		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>


@endsection