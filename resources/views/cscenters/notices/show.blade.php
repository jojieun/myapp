@extends('layouts.main')

@section('content')
	<span class="m-bar2"></span>
	<div class="sub-container bt-ddd">
		<!-- //탭-->
	
		<!-- 상세 컨텐츠내용 -->
		<div class="content-in-sub">
			<!-- 왼쪽메뉴 -->
			@include('cscenters.leftmenu')
						
			<!-- 오른쪽 컨텐츠 -->
			<div class="right-content">
				<h2>공지사항</h2>

				<div class="board_navi_box list">			
					<a href="{{ route('notices.index') }}" class="btn_type">목록으로</a>
				</div>
				<!-- 여기부터 게시판 VIEW 테이블폼입니다. -->
				<div class="table_default view">
					<div class="table_td">
						<div class="table_td_line">
							<span class="subject">{{$notice->title}}</span>
							<span class="date w360">{{$notice->created_at}}  ｜  {{$notice->view_count}}</span>
						</div>
						<div class="txt_view">
							<div class="txt_view_con">
                                @isset($notice->image)
                                <div>
                                <img src="/files/notice/{{$notice->image}}">
                                 </div>
                                @endisset

                                <div>
								{!! nl2br($notice->content) !!}
                                </div>
							</div>
						</div>					
					</div>				
				</div>
				<!-- 여기까지 게시판 테이블폼입니다. -->
			</div>				
		</div>
		<!-- //상세 컨텐츠내용 -->	
	</div>
@endsection